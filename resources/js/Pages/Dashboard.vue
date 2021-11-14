<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-10">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="flex flex-col">
            <div v-if="$page.props.flash.success && show">
              <message
                :message="$page.props.flash.success"
                @click="show = false"
              />
            </div>
            <div v-if="$page.props.flash.destroy && show">
              <message
                :message="$page.props.flash.destroy"
                @click="show = false"
              />
            </div>
            <input-form
              :task="task"
              :csrf="csrf"
              class="flex items-center mt-5 mx-auto"
            />
          </div>
          <tasks-list :tasks="tasks" :csrf="csrf" />
          <pagination :data="tasks" />
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import TasksList from "./TasksList.vue";
import InputForm from "./Components/InputForm.vue";
import Pagination from "./Components/Pagination.vue";
import Message from "./Components/Message.vue";

export default defineComponent({
  components: {
    AppLayout,
    TasksList,
    InputForm,
    Pagination,
    Message,
  },
  props: {
    tasks: Object,
    task: Object,
  },
  data: () => ({
    csrf: document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content"),
    show: true,
  }),
  watch: {
    handler() {
      this.show = true;
    },
  },
});
</script>
