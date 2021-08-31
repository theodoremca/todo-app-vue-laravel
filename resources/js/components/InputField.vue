<template>
  <div class="input">
    <label class="todo">
      <div class="todo__text">
        <textarea v-model="text" type="text"></textarea>
      </div>
    </label>
    <span @click="add"  class="edit-icon"
      ><i class="material-icons">add</i></span
    >
    <!--        <input type="text" style="min-width: 400px; border: none"/>  <span class="edit-icon"><i  class="material-icons">add</i></span>-->
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      text: "",
      message: "",
    };
  },
  methods: {
    add() {
        if(this.text.length === 0){
            alert("this field can't be empty");
            return;
        }
      this.$emit("add", this.text);
    },
  },
};
</script>
<style lang="scss" scoped>
/*** FONTS ***/
@import url(https://fonts.googleapis.com/css?family=Montserrat:900|Raleway:400,400i,700,700i);
@import url(https://fonts.googleapis.com/icon?family=Material+Icons);
@import url(https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css);

/*** VARIABLES ***/
/* Colors */
$black: #1d1f20;
$blue: #83e4e2;
$green: #a2ed56;
$yellow: #fddc32;
%boxshadow {
  box-shadow: 0.25rem 0.25rem 0.6rem rgba(0, 0, 0, 0.05),
    0 0.5rem 1.125rem rgba(75, 0, 0, 0.05);
}
.input {
  background: #fff;
  font-size: 20px;
  max-width: 15em;
  margin: auto;
  padding: 0.5em 1em;
  box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
}

.edit-icon{
    background: linear-gradient(135deg, $blue 0%,$green 100%);
    border-radius: 1rem 1rem 0 1rem;
    position: relative;
    top: -1rem;
    width: 3rem;
    color: $black;
    font: 900 1.5em/1 'Montserrat';
    padding: 0.125em 0.25em;

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
