import { createStore } from 'vuex';
import createPersistedState from 'vuex-persistedstate';
import Cookies from 'js-cookie';

const darkModeClassUpdaterPlugin = (store) => {
  store.subscribe((mutation) => {
    if (mutation.type === 'selectMode') {
      document.getElementById('app').className = store.getters.activatedMode;
    }
  });
};

const store = createStore({
  state() {
    return {
      selectedMode: 'auto',
      activatedMode: 'light',
    };
  },
  mutations: {
    selectMode(state, { mode }) {
      state.selectedMode = mode;
      state.activatedMode = mode;

      if (mode === 'auto') {
        if (window.matchMedia('(prefers-color-scheme: dark)').matches === true) {
          state.activatedMode = 'dark';
        } else {
          state.activatedMode = 'light';
        }
      }
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
      return state.activatedMode;
    },
  },
  plugins: [
    darkModeClassUpdaterPlugin,
    createPersistedState({
      key: 'darkMode',
      storage: {
        getItem: (key) => Cookies.get(key),
        setItem: (key, value) => Cookies.set(key, value, { secure: true }),
        removeItem: (key) => Cookies.remove(key),
      },
    }),
  ],
  strict: true,
});

export default store;
