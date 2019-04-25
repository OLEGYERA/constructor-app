<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->session()->forget('status');

        if($request->isMethod('post')){
            if($request->file_name != null){
                $this->recreateWebPack($request->file_name);
                $this->CreateVueLoader($request->file_name, $request);
                $this->recreateTemplate($request);
                passthru("npm run prod");
            }else{
                $request->session()->flash('status', 'File name is empty!');
            }
            $request->session()->flash('status', 'Приложение успешно создано!');
        }

        return view('home');
    }

    protected function recreateWebPack($file_name){
        File::put('../webpack.mix.js', "const mix = require('laravel-mix');
mix.js('resources/js/". $file_name .".js', 'public/js');");
    }

    protected function recreateTemplate($request){
        $header = null;
        switch ($request->app_header) {
            case 1:
                $header = "Привет, Мир!";
                break;
            case 2:
                $header = "Пока, Мир!";
                break;
        }
        File::put('../resources/js/Vue/Loader.vue', "<template>
    <div>
        ". $header ."
       <Slider></Slider>   
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
");
    }

    protected function CreateVueLoader($file_name, $request){
        $components = null;
        switch ($request->app_content) {
            case 1:
                $components = "Vue.component('slider', require('./components/Slider.vue').default);";
                break;
            case 2:
                $components = "Vue.component('slider', require('./components/Slider-2.vue').default);";
                break;
        }
        File::put('../resources/js/' . $file_name . '.js', "require('./bootstrap');
window.Vue = require('vue');
". $components ."
Vue.component('slider', require('./Vue/Loader.vue').default)
const app = new Vue({
    el: '#app'
});");
    }
}
