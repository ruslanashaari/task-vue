<template>
    <div class="container row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Create Task </h4>
            <div class="col-12 mt-2">
            </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>

            <div>
            <b-form @submit="onSubmit" @reset="onReset">
              <b-form-group
                id="input-group-1"
                label="Task Name:"
                label-for="input-1"
              >
                <b-form-input
                  id="input-1"
                  v-model="form.name"
                  required
                  placeholder="Enter task name"
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-2" label="Task Description:" label-for="input-2">
                <b-form-textarea
                  id="textarea"
                  v-model="form.description"
                  placeholder="Enter some description..."
                  rows="3"
                  max-rows="6"
                ></b-form-textarea>
              </b-form-group>

              <b-button type="submit" variant="primary">Submit</b-button>
              <b-button type="reset" variant="danger">Reset</b-button>
            </b-form>
          </div>

          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>
      <!-- end col-md-12 -->
    </div>
</template>

<script>
    export default {
        props: {
            createTaskApi: {
                type: String,
                default: ''
            },
            taskListUrl: {
                type: String,
                default: ''
            },
        },
        data() {
            return {
                tasks: [],
                form: {
                  name: '',
                  description: '',
                },
                show: true
            }
        },
        mounted: function () {
            
        },
        methods: {
            onSubmit(evt) {
                evt.preventDefault()

                this.createTask();
            },
            onReset(evt) {
                evt.preventDefault()
                // Reset our form values
                this.form.name = ''
                this.form.description = ''
                // Trick to reset/clear native browser form validation state
                this.show = false
                this.$nextTick(() => {
                  this.show = true
                })
            },
            createTask()
            {
                window.axios.post(
                    this.createTaskApi,
                    {
                        name: this.form.name,
                        description: this.form.description,
                    }
                )
                .then((response) => {
                    window.location.href = this.taskListUrl;
                })
            }
        }
    }
</script>
