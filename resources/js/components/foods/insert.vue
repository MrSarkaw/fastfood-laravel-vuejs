<template>
    <div>
        <button class="transform hover:scale-90 transition duration-300 bg-gray-800 text-gray-300 p-2 rounded-lg shadow text-sm px-4 focus:outline-none"
        @click="showModal=true">
               <img src="icon/add.svg" class="w-6 inline" alt="">
                 زیادكردنی خواردن
            </button>
          




            <vue-tailwind-modal :showing="showModal" @close="showModal = false" :showClose="true" class="z-50 bg-gray-800 bg-opacity-50">
                <form class="text-center mb-10" @submit.prevent="insertUser()">
                        <div class="border-b border-blue-900 py-2 w-4/6 mx-auto ">
                            <input v-model="form.name" class="appearance-none bg-transparent w-full text-center border-none text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="ناوی خواردن" :class="{ 'is-invalid': form.errors.has('name') }">
                          <has-error :form="form" field="name" class="text-red-400"></has-error>
                        </div>
                        <div class="border-b border-blue-900 py-2 w-4/6 mx-auto mt-3 ">
                            <input v-model="form.price" class="appearance-none bg-transparent w-full text-center border-none text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="number" placeholder="نرخ" :class="{'is-invalid':form.errors.has('email')}">
                        <has-error :form="form" field="price" class="text-red-400"></has-error>
                        </div>
                      
                         <div class="py-2 w-4/6 mx-auto mt-3">
                              <button class="bg-gray-800 text-gray-300 p-2 rounded-lg w-full shadow text-sm px-4 focus:outline-none"
                                >
                                    <img src="icon/add.svg" class="w-5 inline" alt="" type="submit">
                                        زیاد بكە
                                    </button>
                         </div>
                </form>
            </vue-tailwind-modal>
    </div>
</template>
<script>

export default {
    data(){
        return{
            showModal:false,
            form:new Form({
                name:'',
                price:'',           
            }),
      
        }
    },
   
    methods:{
        insertUser(){
            this.form.post('api/foods').then((response)=>{
               this.form.reset();
               Load.$emit('newFood');
            })
        },
      
      
       
    },
   
}
</script>