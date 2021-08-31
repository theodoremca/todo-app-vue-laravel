<template>
  <div class="container">
    <main>
      <input-field @add="createTodo" ></input-field>
      <ol class="gradient-list">
        <todo
          v-for="todo in todos"
          :key="todo.id"
          :todo="todo"
          @view-task="viewTask"
          @update-todo="updateTodo"
          @delete-todo="deleteTodo"
        ></todo>
      </ol>
    </main>
  </div>
</template>

<script>
import InputField from './InputField.vue';
export default {
  components: { InputField },
  mounted() {
    this.getTodos();
  },
  data() {
    return {
      todos: [],
      message: "",
    };
  },
  methods: {
      createTodo(name){
            let that = this;


            axios
              .post("/api/todo", {
                  name: name,
              })
              .then(function (response) {
                  that.message = response.data;
                  console.log(that.message.message)
              })
              .catch(function (error) {
                  that.message = error;
              })
              .finally(function (response) {
                  that.getTodos();
                  console.log(that.message)
              });


      },
    getTodos() {
      const that = this;
      axios
        .get("/api/todo")
        .then(function (response) {
          that.todos = response.data;
        })
        .catch(function (error) {
          that.todos = error;
        })
        .finally(function (response) {
          console.log(that.todos);
        });
      console.log("Component mounted.");
    },
    updateTodo(update) {
      const that = this;
      axios
        .patch(`/api/todo/${update.id}`, {
          name: update.name,
        })
        .then(function (response) {
          that.message = response.data;
        })
        .catch(function (error) {
          that.message = error;
        })
        .finally(function (response) {
          that.getTodos();
        });
    },
       deleteTodo(id) {
      const that = this;
      axios
        .delete(`/api/todo/${id}`)
        .then(function (response) {
          that.message = response.data;
        })
        .catch(function (error) {
          that.message = error;
        })
        .finally(function (response) {
          that.getTodos();
        });
    },
      viewTask(id){
          console.log("task view")
          this.$emit('view-task',id);
      }
  },
};
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
  box-shadow: 0.25rem 0.25rem 0.6rem rgba(0, 0, 0, 0.05),
    0 0.5rem 1.125rem rgba(75, 0, 0, 0.05);
}

/*** STYLE ***/
*,
*:before,
*:after {
  box-sizing: border-box;
}

html,
body {
  margin: 0;
  padding: 0;
}

body {
  background-color: $white;
  color: $black;
  font-family: "Raleway", sans-serif;
}

main {
  display: block;
  margin: 0 auto;
  max-width: 40rem;
  padding: 1rem;
}

ol.gradient-list {
  counter-reset: gradient-counter;
  list-style: none;
  margin: 1.75rem 0;
  padding-left: 1rem;
  > li {
    background: white;
    border-radius: 0 0.5rem 0.5rem 0.5rem;
    @extend %boxshadow;
    counter-increment: gradient-counter;
    margin-top: 1rem;
    min-height: 3rem;
    padding: 1rem 1rem 1rem 3rem;
    position: relative;

    @for $i from 1 through 5 {
      &:nth-child(10n + #{$i}):before {
        background: linear-gradient(
          135deg,
          rgba($green, $i * 0.2) 0%,
          rgba($yellow, $i * 0.2) 100%
        );
      }
    }
    @for $i from 6 through 10 {
      &:nth-child(10n + #{$i}):before {
        background: linear-gradient(
          135deg,
          rgba($green, 1 - (($i - 5) * 0.2)) 0%,
          rgba($yellow, 1 - (($i - 5) * 0.2)) 100%
        );
      }
    }
    + li {
      margin-top: 2rem;
    }
  }
}
</style>
