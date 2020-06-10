<template>
  <div class="form-group">
    <label
      class="control-label"
      for="saved-searches"
    >
      Saved Searches
    </label>
    <div class="input-group">
      <select
        v-model="selected"
        class="form-control input-sm"
      >
        <option value="">
          -- Please choose --
        </option>
        <option
          v-for="(item, searchIndex) in moduleSavedSearches"
          :key="searchIndex"
          :value="item.id"
        >
          {{ item.name }}
        </option>
      </select>
      <span class="input-group-btn">
        <button
          type="button"
          class="btn btn-default btn-sm"
          :disabled="!selected"
          @click="get()"
        >
          <i class="fa fa-eye" />
        </button>
        <button
          type="button"
          :disabled="!selected"
          class="btn btn-default btn-sm"
          @click="copy()"
        >
          <i class="fa fa-clone" />
        </button>
        <button
          type="button"
          class="btn btn-danger btn-sm"
          :disabled="!selected || selected === searchId"
          @click="remove()"
        >
          <i class="fa fa-trash" />
        </button>
      </span>
    </div>
  </div>
</template>
<script>
import { mapState } from 'vuex'

export default {
  name: 'SavedSearchSelector',
  data () {
    return {
      selected: ''
    }
  },
  computed: {
    ...mapState({
      savedSearches: state => state.search.savedSearches,
      searchId: state => state.search.id,
      userId: state => state.search.user_id,
      currentModel: state => state.search.model
    }),
    moduleSavedSearches () {
      let result = []
      if (this.savedSearches.length) {
        result = this.savedSearches.filter(item => item.model == this.currentModel)
      }

      return result
    }
  },
  created () {
    this.$store.dispatch('search/savedSearchesGet')
  },
  methods: {
    copy () {
      this.$store.dispatch('search/savedSearchCopy', { id: this.selected, user_id: this.userId })
    },
    get () {
      this.$store.dispatch('search/savedSearchGet', this.selected).then(() => {
        this.$emit('saved-search-fetched')
      })
    },
    remove () {
      if (this.selected === this.searchId) {
        return
      }

      if (! confirm('Are you sure you want to delete this saved search?')) {
        return
      }

      this.$store.dispatch('search/savedSearchDelete', this.selected).then(() => {
        this.selected = ''
      })
    }
  }
}
</script>
