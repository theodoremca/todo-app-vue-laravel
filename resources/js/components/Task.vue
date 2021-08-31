<template>
    <div>
<div @click="markTask">

            <div v-if="!editing"  class="todo">
                <input class="todo__state" type="checkbox" :checked="completed" />

                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 200 25" class="todo__icon">
                    <use xlink:href="#todo__line" class="todo__line"></use>
                    <use xlink:href="#todo__box" class="todo__box"></use>
                    <use xlink:href="#todo__check" class="todo__check"></use>
                    <use xlink:href="#todo__circle" class="todo__circle"></use>
                </svg>

                <div class="todo__text">{{task.name}}</div>

            </div>

        <span v-if="editing">  <input v-model="taskText" type="text"></span>

        <span v-if="editing"  @click="updateTodo" class="edit-icon"><i  class="material-icons">save</i></span>
        <span v-else class="edit-icon"   @click="editing = !editing" ><i  class="material-icons">edit</i></span>
        <span @click="deleteTodo" class="delete-icon"><i  class="material-icons">delete</i></span>
</div>
    </div>
</template>

<script>
    export default {
        mounted() {
          this.initializeTask();
        },
        props: ["task"],
        data(){
            return{
                editing:false,
                taskText:'',
                completed:true
            }
        },
        methods: {
            initializeTask(){
                this.taskText=this.task.name;
                this.completed=this.task.completed;

            },
            updateTodo() {
                this.$emit('update-task', {name:this.taskText,id:this.task.id,completed:this.completed});
                this.editing = !this.editing;
            },
            deleteTodo() {
                this.$emit('delete-task', this.task.id);
            },
            markTask(){
this.completed =  this.completed === 0 || this.completed === false ? true : false;
                this.$emit('mark-task', {name:this.taskText,id:this.task.id,completed:this.completed});
            },
            goBack(){
                this.$emit('go-back');
            }
        }
    }
</script>



<style lang="css">


    .todo {
        display: block;
        position: relative;
        padding: 1em 1em 1em 16%;
        margin: 0 auto;
        cursor: pointer;
        border-bottom: solid 1px #ddd;
    }
    .todo:last-child {
        border-bottom: none;
    }
    .todo__state {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }
    .todo__text {
        color: #135156;
        transition: all 0.4s linear 0.4s;
    }
    .todo__icon {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: auto;
        margin: auto;
        fill: none;
        stroke: #27FDC7;
        stroke-width: 2;
        stroke-linejoin: round;
        stroke-linecap: round;
    }
    .todo__line, .todo__box, .todo__check {
        transition: stroke-dashoffset 0.8s cubic-bezier(.9,.0,.5,1);
    }
    .todo__circle {
        stroke: #27FDC7;
        stroke-dasharray: 1 6;
        stroke-width: 0;
        transform-origin: 13.5px 12.5px;
        transform: scale(0.4) rotate(0deg);
        animation: none 0.8s linear;
    }
    @keyframes explode {
    .todo__circle 30% {
        stroke-width: 3;
        stroke-opacity: 1;
        transform: scale(0.8) rotate(40deg);
    }
    .todo__circle 100% {
        stroke-width: 0;
        stroke-opacity: 0;
        transform: scale(1.1) rotate(60deg);
    }
    }
    .todo__box {
        stroke-dasharray: 56.1053, 56.1053;
        stroke-dashoffset: 0;
        transition-delay: 0.16s;
    }
    .todo__check {
        stroke: #27FDC7;
        stroke-dasharray: 9.8995, 9.8995;
        stroke-dashoffset: 9.8995;
        transition-duration: 0.32s;
    }
    .todo__line {
        stroke-dasharray: 168, 1684;
        stroke-dashoffset: 168;
    }
    .todo__circle {
        animation-delay: 0.56s;
        animation-duration: 0.56s;
    }
    .todo__state:checked ~ .todo__text {
        transition-delay: 0s;
        color: #5EBEC1;
        opacity: 0.6;
    }
    .todo__state:checked ~ .todo__icon .todo__box {
        stroke-dashoffset: 56.1053;
        transition-delay: 0s;
    }
    .todo__state:checked ~ .todo__icon .todo__line {
        stroke-dashoffset: -8;
    }
    .todo__state:checked ~ .todo__icon .todo__check {
        stroke-dashoffset: 0;
        transition-delay: 0.48s;
    }
    .todo__state:checked ~ .todo__icon .todo__circle {
        animation-name: explode;
    }
</style>
