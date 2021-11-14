<template>
  <form :action="route('store')" method="post">
    <input
      class="
        rounded
        mr-3
        ml-3
        text-gray-700
        leading-tight
        focus:outline-none focus:shadow-outline
      "
      id="text"
      name="text"
      type="text"
      autocomplete="off"
    />
    <div class="container inline-flex">
      <input type="radio" name="status" id="ativa" value="ativa" checked />
      <label
        class="block mx-3 text-gray-700 text-sm font-bold mb-2"
        for="ativa"
      >
        Ativa
      </label>

      <input type="radio" name="status" id="feita" value="feita" />
      <label
        class="block mx-3 text-gray-700 text-sm font-bold mb-2"
        for="feita"
      >
        Feita
      </label>

      <input type="radio" name="status" id="cancelada" value="cancelada" />
      <label
        class="block mx-3 text-gray-700 text-sm font-bold mb-2"
        for="cancelada"
      >
        Cancelada
      </label>
    </div>
    <input type="hidden" name="_method" value="post" />
    <input type="hidden" name="_token" :value="csrf" />
    <button
      type="submit"
      class="
        bg-green-400
        hover:bg-green-600
        text-white
        font-bold
        text-xs
        px-1
        rounded
        h-10
      "
    >
      <span>Cadastrar</span>
    </button>
  </form>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default defineComponent({
  components: {
    AppLayout,
  },
  props: {
    task: Object,
    csrf: String,
  },
});
</script>
