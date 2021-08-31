<template>
    <div>
        <button @click="goBack">Go back </button>
        <h2>{{todo.name}} Tasks</h2>
        <input-field @add="createTask" ></input-field>
        <svg viewBox="0 0 0 0" style="position: absolute; z-index: -1; opacity: 0;">
            <defs>
                <linearGradient id="boxGradient" gradientUnits="userSpaceOnUse" x1="0" y1="0" x2="25" y2="25">
                    <stop offset="0%"   stop-color="#27FDC7"/>
                    <stop offset="100%" stop-color="#0FC0F5"/>
                </linearGradient>

                <linearGradient id="lineGradient">
                    <stop offset="0%"    stop-color="#0FC0F5"/>
                    <stop offset="100%"  stop-color="#27FDC7"/>
                </linearGradient>

                <path id="todo__line" stroke="url(#lineGradient)" d="M21 12.3h168v0.1z"></path>
                <path id="todo__box" stroke="url(#boxGradient)" d="M21 12.7v5c0 1.3-1 2.3-2.3 2.3H8.3C7 20 6 19 6 17.7V7.3C6 6 7 5 8.3 5h10.4C20 5 21 6 21 7.3v5.4"></path>
                <path id="todo__check" stroke="url(#boxGradient)" d="M10 13l2 2 5-5"></path>
                <circle id="todo__circle" cx="13.5" cy="12.5" r="10"></circle>
            </defs>
        </svg>
        <div class="todo-list">
            <task
                v-for="task in tasks"
                :key="task.id"
                :task="task"
                @view-task="viewTask"
                @update-task="updateTask"
                @delete-task="deleteTask"
                @mark-task="markTask"
            ></task>
        </div>
    </div>
</template>

<script>
    import InputField from "./InputField";

    export default {
        components: { InputField },
        mounted() {
            this.getTasks();
        },
        props: ["todo"],
        data() {
            return {
                tasks: [],
                message: "",
            };
        },
        methods: {
            createTask(name){
                let that = this;
                axios
                    .post("/api/task", {
                        name: name,
                        todo_id:this.todo.id
                    })
                    .then(function (response) {
                        that.message = response.data;
                        console.log(that.message.message)
                    })
                    .catch(function (error) {
                        that.message = error;
                    })
                    .finally(function (response) {
                        that.getTasks();
                        console.log(that.message)
                    });


            },
            getTasks() {
                const that = this;
                axios
                    .get(`/api/task/${this.todo.id}`)
                    .then(function (response) {
                        that.tasks = response.data;
                    })
                    .catch(function (error) {
                        that.tasks = error;
                    })
                    .finally(function (response) {
                        console.log(that.tasks);
                    });
                console.log("Component mounted.");
            },
            updateTask(update) {
                const that = this;
                axios
                    .patch(`/api/task/${update.id}`, {
                        name: update.name,
                        todo_id:this.todo.id,
                        completed:update.completed
                    })
                    .then(function (response) {
                        that.message = response.data;
                    })
                    .catch(function (error) {
                        that.message = error;
                    })
                    .finally(function (response) {
                        that.getTasks();
                    });
            },
            markTask(update) {
                const that = this;
                axios
                    .patch(`/api/task/${update.id}`, {
                        name: update.name,
                        todo_id:this.todo.id,
                        completed:update.completed
                    })
                    .then(function (response) {
                        that.message = response.data;
                    })
                    .catch(function (error) {
                        that.message = error;
                    })
                    .finally(function (response) {

                    });
            },
            deleteTask(id) {
                const that = this;
                axios
                    .delete(`/api/task/${id}`)
                    .then(function (response) {
                        that.message = response.data;
                    })
                    .catch(function (error) {
                        that.message = error;
                    })
                    .finally(function (response) {
                        that.getTasks();
                    });
            },
            viewTask(){


            },
            goBack(){
                this.$emit('go-back');
            }
        },
    }
</script>

<style lang="scss" >

    h2{
        margin: auto;
        max-width: 15em;
        text-align: center;
    }

    .todo-list {
        background: #FFF;
        font-size: 20px;
        max-width: 15em;
        margin: auto;
        padding: 0.5em 1em;
        box-shadow: 0 5px 30px rgba(0,0,0,0.2);
    }

    html {
        background: #ddd;
    }
    html {
        height: 100%;
        display: flex;
    }
    body {
        width: 100%;
        margin: auto;
    }
</style>
