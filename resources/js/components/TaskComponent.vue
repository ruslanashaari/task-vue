<template>
    <div class="container row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
              <a class="btn btn-primary btn-round text-white pull-right" :href="taskCreateUrl">Add Task</a>
            <h4 class="card-title"> Tasks </h4>
            <div class="col-12 mt-2">
            </div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Created By</th>
                  <th>Status</th>
                  <th class="disabled-sorting text-right">Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Created By</th>
                  <th>Status</th>
                  <th class="disabled-sorting text-right">Actions</th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="task in tasks">
                    <td>{{ task.name }}</td>
                    <td>{{ task.description }}</td>
                    <td>{{ task.created_by }}</td>
                    <td>{{ task.completed }}</td>
                      <td class="text-right">
                        
                        <b-button variant="danger" size="sm" @click="confirmDelete(task, row.index, $event.target)" class="mr-1"></b-button>

                    </td>
              </tr>
              </tbody>
            </table>

            <!-- Delete modal -->
            <b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal" ref="confirmModal" hide-footer>

              <div class="d-block text-center">
                <h3>{{ infoModal.content }}</h3>
            </div>

              <b-button variant="danger" title='Delete' class="mt-3" block @click="deleteTask(infoModal.taskId)">Confirm Delete</b-button>
            </b-modal>

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
            taskListApi: {
                type: String,
                default: ''
            },
            taskCreateUrl: {
                type: String,
                default: ''
            },
        },
        data() {
            return {
                tasks: [],
                infoModal: {
                  id: 'info-modal',
                  title: '',
                  content: ''
                }
            }
        },
        mounted: function () {
            this.getTaskList();
        },
        methods: {
            getTaskList()
            {
                window.axios.get(this.taskListApi)
                .then((response) => {
                        this.tasks = response.data.data.data;
                    });
            },
            resetInfoModal() {
              this.infoModal.title = ''
              this.infoModal.content = ''
            },
            confirmDelete(item, index, button) {
              this.infoModal.title = `Delete Confirmation`
              this.infoModal.content = `Confirmation to delete ${item.name} ?`
              this.infoModal.taskId = `${item.id}`
              this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
        }
    }
</script>
