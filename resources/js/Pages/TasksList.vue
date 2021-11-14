<template>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div
          class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
        >
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="table-th">Tarefa</th>
                <th scope="col" class="table-th">Status</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" v-if="tasks">
              <tr v-for="task in tasks.data" :key="task.id">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900 inline-flex">
                    <form :action="route('delete', task.id)" method="post">
                      <!-- TRASH ICON -->
                      <button type="submit">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-5 w-5 mr-7 text-red-400 hover:text-red-600"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                          />
                        </svg>
                      </button>
                      <input type="hidden" name="_token" :value="csrf" />
                      <input type="hidden" name="_method" value="delete" />
                    </form>
                    <div v-if="textEditing === task.id">
                      <input
                        type="text"
                        v-model="task.text"
                        :id="`tag-edit-${task.id}`"
                        @blur="emptyIsEditing('text')"
                        @keydown.enter="
                          emptyIsEditing('text'), updateTask(task)
                        "
                      />
                    </div>
                    <div v-else @click="setToEditing(task, 'text')">
                      {{ task.text }}
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="'status-' + task.status">
                    <div v-if="statusEditing === task.id">
                      <select
                        name="status"
                        :id="`edit-status-${task.id}`"
                        v-model="task.status"
                        @blur="emptyIsEditing('status')"
                        @keydown="emptyIsEditing('status'), updateTask(task)"
                        @click.once="emptyIsEditing('status'), updateTask(task)"
                      >
                        <option value="feita">feita</option>
                        <option value="ativa">ativa</option>
                        <option value="cancelada">cancelada</option>
                      </select>
                    </div>
                    <div v-else @click="setToEditing(task, 'status')">
                      {{ task.status }}
                    </div>
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { defineComponent } from "vue";
export default defineComponent({
  components: {},
  props: {
    tasks: Object,
    csrf: String,
  },
  data() {
    return {
      textEditing: "",
      statusEditing: "",
    };
  },
  methods: {
    setToEditing(task, field) {
      if (field === "text") {
        this.textEditing = task.id;

        setTimeout(() => {
          document.getElementById(`tag-edit-${task.id}`).focus();
        }, 1);
      }

      if (field === "status") {
        this.statusEditing = task.id;

        setTimeout(() => {
          document.getElementById(`edit-status-${task.id}`).focus();
        }, 1);
      }
    },
    emptyIsEditing(field) {
      if (field === "text") {
        this.textEditing = "";
      } else {
        this.statusEditing = "";
      }
    },
    updateTask(task) {
      axios
        .patch(route("update", task.id), {
          id: task.id,
          text: task.text,
          status: task.status,
        })
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
});
</script>
