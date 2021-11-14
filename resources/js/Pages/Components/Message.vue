<template>
  <div
    class="flex items-center justify-between rounded text-white w-full relative"
    :class="{
      'bg-green-400': message == $page.props.flash.success,
      'bg-yellow-500': message == $page.props.flash.destroy,
    }"
  >
    <div class="flex items-center">
      <div v-if="$page.props.flash.success">
        <svg
          class="ml-4 mr-2 flex-shrink-0 w-4 h-4 fill-white"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
          fill="green"
        >
          <polygon points="0 11 2 9 7 14 18 3 20 5 7 18" />
        </svg>
      </div>
      <div v-else>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="ml-4 mr-2 w-7 h-7 stroke-2"
          fill="none"
          stroke="white"
        >
          <path
            strokeLinecap="round"
            strokeLinejoin="round"
            strokeWidth="{2}"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
          />
        </svg>
      </div>
      <div class="py-4 text-white text-sm font-medium">
        {{ message }}
      </div>
      <button @click="show = false">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-4 w-4 absolute top-3 right-2"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </button>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    message: String,
  },
});
</script>
