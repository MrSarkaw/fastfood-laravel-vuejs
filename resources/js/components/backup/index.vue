<template>
    <div>
        <div class="w-12 md:w-6/12 mx-auto p-2 rounded-lg bg-gray-800 text-center">
                <button @click="backup" class="focus:outline-none bg-gray-300 p-2 px-4 rounded-md mx-auto transform transition duration-300 hover:scale-110">
                    وەرگرتنی باكئەپ
                </button>
            
            <div class="w-full border-solid border-t-2 border-gray-300 pt-2 mt-2">
                    <div class="bg-gray-300 text-gray-800 p-2 rounded-lg w-full mt-2" 
                    v-for="(item,index) in backups" :key="index">
                        {{item}}
                    </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            backups:[]
        }
    },
    methods:{
        backup(){
            axios.post('api/backup').then(()=>{
                 this.$swal("", "بەسەركەوتووی باكئەپ بوو", "success");
                 Load.$emit('backup');
            })
        },
        load(){
            axios.get('api/backup').then(({data})=>{
                this.backups=data.files;
                
            })
        },
    },
    created(){
        Load.$on('backup',()=>{
            this.load();
        })
        this.load();
    }
}
</script>