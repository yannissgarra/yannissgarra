<template>
  <button
    class="w-4 h-4 flex items-center justify-center rounded-full md:w-6 md:h-6"
    :class="{ 'text-gray-400': !isSelected, 'bg-gray-400 text-white': isSelected }"
    @click="select"
  >
    <i :class="modeIcon" />
  </button>
</template>

<script>
import { defineComponent, computed } from 'vue';
import { useStore } from 'vuex';

export default defineComponent({
  props: {
    mode: {
      type: String,
      required: true,
      validator(value) {
        return ['auto', 'light', 'dark'].includes(value);
      },
    },
    modeIcon: {
      type: String,
      required: true,
    },
  },
  setup(props) {
    const store = useStore();

    const isSelected = computed(() => store.getters.selectedMode === props.mode);

    function select() {
      store.dispatch('selectMode', { mode: props.mode });
    }

    return {
      isSelected,
      select,
    };
  },
});
</script>
