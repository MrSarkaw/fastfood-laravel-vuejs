<template>
    <div>
        <button class="bg-gray-800 p-2 px-4 rounded-md text-gray-300  text-xs"
        @click="filterModal=true">
            فلتەر كردن
        </button>
        <div class="w-full grid grid-cols-4 gap-10 text-center pt-10 ">
           <div v-for="(item,index) in order" :key="index"  
                class="shadow-lg p-5 rounded-lg text-gray-800
                hover:bg-gray-800 hover:text-gray-300 transform transition duration-300 hover:translate-y-3
                hover:scale-90">
               {{item}}
            </div> 
        </div>
        <div class="mt-10 text-center w-full">
            <span class="bg-gray-800 text-gray-300 p-2 px-4 rounded text-sm">
                كۆی گشتی : <span  class="text-gray-800 bg-gray-300 p-1 px-4 rounded text-sm">
                    {{total|toCurrency}} 
                    </span>
            </span>
        </div>


        
 <vue-tailwind-modal
      :showing="filterModal"
      @close="filterModal = false"
      :showClose="true"
      class="z-50 bg-gray-800 bg-opacity-25"
    >
    <div class="mt-10"></div>
    <p>فلتەربكە بە پێی ناو : </p>
    <select  v-model="selectedName" id="" class="w-full bg-gray-800 text-gray-300 p-2 rounded ">
        <option value="">گشتی</option>
        <option v-for="(item,index) in name" :key="index"
                :value="item" class="p-2"
                @change="selectedName=item">{{item}}</option>
    </select>

    <p class="mt-4">فلتەربكە بە پێی كات
    </p>

    <div class="w-full p-2 bg-gray-800 text-gray-300 text-center rounded-lg">
        <p>
            لە بەرواری :
        <input type="date" name="" id="" class="w-8/12 p-1 text-gray-800 rounded" v-model="startDate">
        </p>
        <p class="mt-5">
            بۆ بەرواری :
        <input type="date" name="" id="" class="w-8/12 p-1 text-gray-800 rounded" v-model="endDate">
        </p>
    </div>
    <button class="bg-gray-800 text-gray-300 p-1 w-full mt-10 px-4 rounded-lg" @click="filters">
        فلتەركردن
    </button>

   
    </vue-tailwind-modal>


    </div>
</template>

<script>
export default {
    data(){
        return{
            selectedName:'',
            startDate:'',
            endDate:'',
            filterModal:false,
            order:[],
            name:[],
            total:0,
        }
    },
    methods:{
        load(){
            axios.get('api/report').then(({data})=>{
                this.order=data.order;
                this.total=data.total;
                this.name=data.name;
            })
        },
          filters() {
            axios.get('api/filterSearch',{
                params:{

                    'name':this.selectedName,
                    'startDate':this.startDate,
                    'endDate':this.endDate,
                }
                
            }).then(({data})=>{
                if(data.order.length>0){
                         this.order=data.order;
                        this.total=data.total;
                        this.filterModal=false;
                }else{
                    this.$swal("", "نەدۆزرایەوە", "warning");
                }
                
            })
         },
    },
    created(){
        this.load();
    }
}
</script>