<template>
    <li @dblclick="viewTask">

  <span v-if="!editing">  {{ todo.name }}</span>
  <span v-if="editing">  <input v-model="todoText" type="text"></span>
        <span v-if="editing"  @click="updateTodo" class="edit-icon"><i  class="material-icons">save</i></span>
        <span v-else class="edit-icon"   @click="editing = !editing" ><i  class="material-icons">edit</i></span>
        <span @click="deleteTodo" class="delete-icon"><i  class="material-icons">delete</i></span>
    </li>
</template>

<script>
    export default {
        props: ["todo"],
        mounted() {
            this.todoText = this.todo.name;
        },
        data() {
            return{
                editing:false,
                todoText:''
            }
        },
        methods: {
              updateTodo() {
                this.$emit('update-todo', {name:this.todoText,id:this.todo.id});
                 this.editing = !this.editing;
              },
              deleteTodo() {
                this.$emit('delete-todo', this.todo.id);
              },
            viewTask(){
                this.$emit('view-task',this.todo);
            }
        }


    }
</script>
<style lang="scss" scoped>
/*** FONTS ***/
@import url(https://fonts.googleapis.com/css?family=Montserrat:900|Raleway:400,400i,700,700i);
@import url(https://fonts.googleapis.com/icon?family=Material+Icons);



/*** VARIABLES ***/
/* Colors */
$black: #1d1f20;
$blue: #83e4e2;
$green: #a2ed56;
$yellow: #fddc32;
$white: #fafafa;



/*** EXTEND ***/
/* box-shadow */
%boxshadow {
  box-shadow: 0.25rem 0.25rem 0.6rem rgba(0,0,0,0.05), 0 0.5rem 1.125rem rgba(75,0,0,0.05);
}



/*** STYLE ***/
*,
*:before,
*:after {
  box-sizing: border-box;
}



.edit-icon{
      background: linear-gradient(135deg, $blue 0%,$green 100%);
      border-radius: 1rem 1rem 0 1rem;
      content: '';
      height: 3rem;
      right: 3rem;
      overflow: hidden;
      position: absolute;
      top: -1rem;
      width: 3rem;
      color: $black;
      display: flex;
      font: 900 1.5em/1 'Montserrat';
      justify-content: flex-end;
      padding: 0.125em 0.25em;
      z-index: 1;
}

.delete-icon{
      background: linear-gradient(135deg, $blue 0%,$green 100%);
      border-radius: 1rem 1rem 0 1rem;
      content: '';
      height: 3rem;
      right: -1rem;
      overflow: hidden;
      position: absolute;
      top: -1rem;
      width: 3rem;
      color: $black;
      display: flex;
      font: 900 1.5em/1 'Montserrat';
      justify-content: flex-end;
      padding: 0.125em 0.25em;
      z-index: 1;
}

</style>
