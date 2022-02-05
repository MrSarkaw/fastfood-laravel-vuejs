@extends('layouts.app')

@section('content')
<div class="h-screen">
    <div class="bg-gray-800 flex justify-center items-center" style="height: 5%">
            <p class="uppercase text-white font-bold">FastFood Name</p>
    </div>
    <div class="w-full p-2 overflow-y-scroll datas" style="height:85%">
        <router-view></router-view>
    </div>

    <div class="bg-gray-800 flex justify-center items-center" style="height: 10%">
            <router-link to="/home" class="transform hover:scale-125 transition transition ease-in-out duration-300">
                <img src="icon/home-512.png" class="w-12 m-4" alt="">
            </router-link>
            <router-link to="/users" class="transform hover:scale-125 transition transition ease-in-out duration-300">
                <img src="icon/10_avatar-512.png" class="w-12 m-4" alt="">
            </router-link>
             <router-link to="/foods" class="transform hover:scale-125 transition transition ease-in-out duration-300">
                <img src="icon/food.png" class="w-12 m-4" alt="">
            </router-link>
             <router-link to="/order" class="transform hover:scale-125 transition transition ease-in-out duration-300">
                <img src="icon/mainorder.png" class="w-12 m-4" alt="">
            </router-link>
             <router-link to="/showSell" class="transform hover:scale-125 transition transition ease-in-out duration-300">
                <img src="icon/sell.png" class="w-12 m-4" alt="">
            </router-link>
               <router-link to="/report" class="transform hover:scale-125 transition transition ease-in-out duration-300">
                <img src="icon/raport.png" class="w-12 m-4" alt="">
            </router-link>
            <router-link to="/backup" class="transform hover:scale-125 transition transition ease-in-out duration-300">
                <img src="icon/backup.png" class="w-12 m-4" alt="">
            </router-link>
            <router-link to="/change" class="transform hover:scale-125 transition transition ease-in-out duration-300">
                <img src="icon/setting.png" class="w-12 m-4" alt="">
            </router-link>
      
        <form action="{{route('logout')}}" method="POST">
            @csrf
          <button type="submit" class="transform hover:scale-125 mt-2 focus:outline-none transition transition ease-in-out duration-300">
                <img src="icon/shutdown.png" class="w-12 m-4" alt="">
          </button>
        </form>
       
    </div>

</div>
@endsection
