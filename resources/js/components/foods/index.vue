<template>
    <div>
     <insert-user  class="mt-1 z-50  border-b-2 border-gray-800 pb-4"></insert-user>
    
    
     <div class="w-full text-center mt-2">
           <input type="text" class="focus:outline-none py-1 bg-transparent
                                     border-solid border-b-2 border-gray-800 pb-1
                                     text-center text-gray-800"
                                     placeholder="گەڕان ئەنجام بە"
                                     v-model="search"
                                     @keyup="searchMethod">
         </div>


     <div class="w-full p-4 pt-10 mt-6 gap-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3" v-if="search!=''">
         <div
         v-for="(item,index) in foodsBySearch" :key="index"
          class="p-2 rounded-lg text-white transform transition duration-300 hover:scale-90 text-center relative bg-gray-800" >
             <div class="w-5/12 mx-auto">
                  <p>{{item.name}}</p>
                  <p class="text-xs bg-gray-300 px-2 inline rounded text-gray-800">{{item.price|toCurrency}}</p>
                
             </div>
                <div class="p-1 rounded bg-gray-800" style="position:absolute;top:-38px;right:42%">
                        <button
                            class="bg-red-400 p-2 rounded focus:outline-none"
                            @click="deleteFood(item.id, index)"
                        >
                            <img src="icon/delete.svg" class="w-3" alt="" />
                        </button>
                        <button class="bg-blue-400 p-2 rounded focus:outline-none" @click="loadSingleFood(item.id)">
                            <img src="icon/edit.svg" class="w-3" alt="" />
                        </button>
                      
                </div>
            <img src="icon/food.png" class="inline w-24 transform transition duration-300 hover:rotate-180" style="position:absolute;top:-17px;right:20px"  alt="">              
            <img src="icon/food.png" class="inline w-24 transform transition duration-300 hover:rotate-180" style="position:absolute;top:-17px;left:20px"  alt="">              
         </div>

         
     </div>
     <div class="w-full p-4 pt-10 mt-6 gap-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3" v-else>
         <div
         v-for="(item,index) in foods" :key="index"
          class="p-2 rounded-lg text-white transform transition duration-300 hover:scale-90 text-center relative bg-gray-800" >
             <div class="w-5/12 mx-auto">
                  <p>{{item.name}}</p>
                  <p class="text-xs bg-gray-300 px-2 inline rounded text-gray-800">{{item.price|toCurrency}}</p>
                
             </div>
                <div class="p-1 rounded bg-gray-800" style="position:absolute;top:-38px;right:42%">
                        <button
                            class="bg-red-400 p-2 rounded focus:outline-none"
                            @click="deleteFood(item.id, index)"
                        >
                            <img src="icon/delete.svg" class="w-3" alt="" />
                        </button>
                        <button class="bg-blue-400 p-2 rounded focus:outline-none" @click="loadSingleFood(item.id)">
                            <img src="icon/edit.svg" class="w-3" alt="" />
                        </button>
                      
                </div>
            <img src="icon/food.png" class="inline w-24 transform transition duration-300 hover:rotate-180" style="position:absolute;top:-17px;right:20px"  alt="">              
            <img src="icon/food.png" class="inline w-24 transform transition duration-300 hover:rotate-180" style="position:absolute;top:-17px;left:20px"  alt="">              
         </div>

         
     </div>


 <vue-tailwind-modal
      :showing="updateModal"
      @close="updateModal = false"
      :showClose="true"
      class="z-50 bg-gray-800 bg-opacity-25"
    >
    
      <form class="text-center mb-10" @submit.prevent="updateFood(formUpdate.id)">
        <div class="border-b border-blue-900 py-2 w-4/6 mx-auto">
          <input
            v-model="formUpdate.name"
            class="appearance-none bg-transparent w-full text-center border-none text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            type="text"
            placeholder="ناوی خواردن"
            :class="{ 'is-invalid': formUpdate.errors.has('name') }"
          />
          <has-error :form="formUpdate" field="name" class="text-red-400"></has-error>
        </div>
        <div class="border-b border-blue-900 py-2 w-4/6 mx-auto mt-3">
          <input
            v-model="formUpdate.price"
            class="appearance-none bg-transparent w-full text-center border-none text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            type="text"
            placeholder="نرخ"
            :class="{ 'is-invalid': formUpdate.errors.has('price') }"
          />
          <has-error
            :form="formUpdate"
            field="price"
            class="text-red-400"
          ></has-error>
        </div>
        <div class="py-2 w-4/6 mx-auto mt-3">
          <button
            class="bg-gray-800 text-gray-300 p-2 rounded-lg w-full shadow text-sm px-4 focus:outline-none"
          >
            تازەی بكەرەوە
          </button>
          <br>

        </div>
         <p class="p-1 px-2 text-sm rounded  text-gray-800 m-1" v-if="formUpdate.user!=null">
           زيادكراوە لەلایەن {{formUpdate.user.name}}
         </p>
         <p class=" p-1 px-2 text-sm rounded  text-gray-800 m-1" style="direction:ltr">
          {{formUpdate.created_at|time}}
         </p>
      </form>
    </vue-tailwind-modal>


    </div>
</template>

<script>
import insertUser from "./insert.vue";
export default {
    data(){
        return{
          search:'',
          foodsBySearch:[],
          foods:[],
          updateModal: false,
          formUpdate:new Form({
                    id:'',
                    name:'',
                    price:'',
                    created_at:'',
                    user:[],
                  })
        }
    },
    components: {
    insertUser,
  },
  methods:{
      loadFood(){
          axios.get('api/foods').then(({data})=>{
                this.foods=data.foods;
                }
             )
          },
           deleteFood(data, index) {
            this.$swal({
                title: "دڵنیای لە سڕینەوەی",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "بەڵێ",
                cancelButtonText: "نەخێر",
                showCloseButton: true,
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.value) {
                this.$swal("", "بەسەركەوتووی سڕایەوە", "success");
                axios.delete("api/foods/" + data + "").then(() => {
                    this.foods.splice(index, 1);
                });
                } else {
                this.$swal("پەشمان بویتەوە", "", "info");
                }
            });
        },
      
       loadSingleFood(id){
            this.formUpdate.reset();
                axios.get("api/foods/"+id+"").then(({ data }) => {
                this.formUpdate.fill(data.food[0]);
                this.updateModal=true;
            });
        },
         updateFood(id){
            this.formUpdate.put('api/foods/'+id+'').then(()=>{
            Load.$emit('newFood');
            this.updateModal=false;
            })
        },
        searchMethod(){
          if(this.search!=''){
            axios.get('api/searchFood/'+this.search+'').then(({data})=>{
              this.foodsBySearch=data.food
            })
          }
        }
      },
      created(){
          Load.$on('newFood',()=>{
              this.loadFood();
          })
          this.loadFood();
      }
  }

</script>