<template>
    <div class="container">
        <tasks :todo="todo" v-if="viewTask" @go-back="viewTask=!viewTask"></tasks>
    <todos @view-task="toggleToTask" v-else></todos>
    </div>
</template>

<script>
    import Todos from "./Todos";
    import Tasks from "./Tasks";
    export default {
        components: {Todos,Tasks},
        mounted() {
            console.log('Component mounted.')

        },
        data(){
            return{
            viewTask:false,
                todo:{}
            }
        },
        methods:{
            toggleToTask(todo){
                this.todo=todo;
                this.viewTask=true;

            }
        }
    }
</script>
