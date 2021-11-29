import { createStore } from 'vuex';

const darkModeClassUpdaterPlugin = (store) => {
  store.subscribe((mutation) => {
    if (mutation.type === 'selectMode') {
      document.getElementById('app').className = store.getters.activatedMode;
    }
  });
};

export default createStore({
  state() {
    return {
      selectedMode: 'auto',
    };
  },
  mutations: {
    selectMode(state, { mode }) {
      state.selectedMode = mode;
    },
  },
  actions: {
    selectMode({ commit }, { mode }) {
      commit('selectMode', { mode });
    },
  },
  getters: {
    selectedMode(state) {
      return state.selectedMode;
    },
    activatedMode(state) {
      if (state.selectedMode === 'auto') {
        if (window.matchMedia('(prefers-color-scheme: dark)').matches === true) {
          return 'dark';
        }

        return 'light';
      }

      return state.selectedMode;
    },
  },
  plugins: [
    darkModeClassUpdaterPlugin,
  ],
});
