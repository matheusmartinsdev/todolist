<template>
  <Head title="Welcome" />

  <div class="flex container mx-auto items-center justify-center align-center">
    <div v-if="isLogged">
      <Link href="/dashboard"> Ir para dashboard </Link>
    </div>

    <div v-else class="container mx-auto">
      <login></login>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Login from "./Auth/Login.vue";

export default defineComponent({
  components: {
    Head,
    Link,
    Login,
  },

  props: {
    isLogged: Boolean,
  },

  methods: {
    redirect(isLogged) {
      isLogged ? redirect("dashboard") : redirect("form");
    },
  },
});
</script>
