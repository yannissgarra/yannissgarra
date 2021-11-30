<template>
  <ul class="p-0.5 flex border border-gray-400 rounded-full text-xs md:p-1 md:text-base">
    <li>
      <DarkModeTogglerOption mode="auto" mode-icon="fas fa-adjust" />
    </li>

    <li class="ml-1">
      <DarkModeTogglerOption mode="light" mode-icon="far fa-circle" />
    </li>

    <li class="ml-1">
      <DarkModeTogglerOption mode="dark" mode-icon="fas fa-circle" />
    </li>
  </ul>
  {{ activatedMode }}
</template>

<script>
import { defineComponent } from 'vue';
import { useStore } from 'vuex';
import DarkModeTogglerOption from '@/components/DarkModeTogglerOption.vue';

export default defineComponent({
  components: {
    DarkModeTogglerOption,
  },
  setup() {
    const store = useStore();

    store.dispatch('selectMode', { mode: store.getters.selectedMode });
  },
});
</script>
