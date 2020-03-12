<template>
  <div class="form-group">
    <label
      class="control-label"
      for="save-search"
    >
      Save Search
    </label>
    <div class="input-group">
      <div class="form-group input text required">
        <input
          v-model="name"
          type="text"
          class="form-control input-sm"
          placeholder="Saved search name"
          required="required"
        >
      </div>
      <span class="input-group-btn">
        <button
          type="button"
          class="btn btn-sm btn-primary"
          :disabled="!name"
          @click="save()"
        >
          <i
            class="fa fa-floppy-o"
            aria-hidden="true"
          />
        </button>
      </span>
    </div>
  </div>
</template>
<script>
export default {
  name: 'SaveSearch',
  computed: {
    name: {
      get() {
        return this.$store.state.search.name
      },
      set(value) {
        this.$store.commit('search/name', value)
      }
    }
  },
  methods: {
    save() {
      this.$store.dispatch('search/savedSearchSave', { id: this.selected, user_id: this.userId })
    }
  }
}
</script>
