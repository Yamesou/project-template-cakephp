<template>
  <div>
    <div class="input-group">
      <input
        v-model="rruleString"
        type="text"
        class="form-control"
        placeholder="Recurrence Rule"
        disabled="true"
      >
      <input
        v-model="rruleRaw"
        :name="name"
        type="hidden"
      >
      <span class="input-group-btn">
        <a
          href="#"
          class="btn btn-default"
          data-toggle="modal"
          data-target="#recurrModal"
        >
          <i class="fa fa-calendar" />
        </a>
      </span>
    </div>
    <div
      id="recurrModal"
      class="recurrence-container modal"
      tabindex="-1"
      role="dialog"
    >
      <div
        class="modal-dialog"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
            <h4
              id="myModalLabel"
              class="modal-title"
            >
              Configure recurrence
            </h4>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="frequencies-container col-xs-12">
                <ul class="list-inline">
                  <li
                    v-for="freq in frequencies"
                    :key="freq.value"
                  >
                    <label>
                      <input
                        v-model="frequency"
                        :value="freq.value"
                        type="radio"
                      >
                      {{ freq.name }}
                    </label>
                  </li>
                </ul>
                <hr>
              </div>
            </div>
            <div class="row">
              <div class="weekdays col-xs-12">
                <ul class="list-inline">
                  <li
                    v-for="weekday in weekdays"
                    :key="weekday.value"
                  >
                    <label>
                      <input
                        v-model="byweekday"
                        :value="weekday.value"
                        type="checkbox"
                      >
                      {{ weekday.name }}
                    </label>
                  </li>
                </ul>
              </div>
            </div> <!-- .row -->
            <hr>

            <div class="row">
              <div class="count col-xs-6 col-md-6">
                <div class="form-group">
                  <label>Number of Times:</label>
                  <input
                    v-model="count"
                    type="text"
                    class="form-control"
                    placeholder="e.g. 3 times"
                  >
                </div>
              </div>

              <div class="interval col-xs-6 col-md-6">
                <div class="form-group">
                  <label>Occurrences:</label>
                  <input
                    v-model="interval"
                    type="text"
                    class="form-control"
                    placeholder="# of Occurrences"
                  >
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xs-12">
                <ul class="list-inline">
                  <li
                    v-for="month in months"
                    :key="month.value"
                  >
                    <label>
                      <input
                        v-model="bymonth"
                        :value="month.value"
                        type="checkbox"
                      >
                      {{ month.name }}
                    </label>
                  </li>
                </ul>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xs-12">
                <strong>Recurrence:</strong> <em>{{ rruleString }}</em><br>
                <strong>Rule:</strong> <em>{{ rruleRaw }}</em>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-default"
              @click="clearRRule"
            >
              Clear
            </button>
            <button
              type="button"
              class="btn btn-primary"
              data-dismiss="modal"
            >
              Save
            </button>
          </div>
        </div> <!-- modal-content -->
      </div> <!-- modal-dialog -->
    </div> <!-- recurrence-container -->
  </div> <!-- global container -->
</template>

<script>
import { RRule, rrulestr } from 'rrule'

export default {
  props: {
    name: {
      type: String,
      default: '',
      required: false
    },
    recurrenceData: {
      type: String,
      default: '',
      required: false
    }
  },
  data () {
    return {
      rruleString: null,
      rruleRaw: null,
      count: null,
      interval: 1,
      frequency: null,
      byweekday: [],
      bymonth: [],
      months: [
        { name: 'Jan', value: 1 },
        { name: 'Feb', value: 2 },
        { name: 'Mar', value: 3 },
        { name: 'Apr', value: 4 },
        { name: 'May', value: 5 },
        { name: 'Jun', value: 6 },
        { name: 'Jul', value: 7 },
        { name: 'Aug', value: 8 },
        { name: 'Sep', value: 9 },
        { name: 'Oct', value: 10 },
        { name: 'Nov', value: 11 },
        { name: 'Dec', value: 12 }
      ],
      weekdays: [
        { name: 'MO', value: 'MO' },
        { name: 'TU', value: 'TU' },
        { name: 'WE', value: 'WE' },
        { name: 'TH', value: 'TH' },
        { name: 'FR', value: 'FR' },
        { name: 'SA', value: 'SA' },
        { name: 'SU', value: 'SU' }
      ],
      frequencies: [
        { name: 'Yearly', value: 0 },
        { name: 'Monthly', value: 1 },
        { name: 'Weekly', value: 2 },
        { name: 'Daily', value: 3 },
        { name: 'Hourly', value: 4 },
        { name: 'Minutely', value: 5 }
      ]
    }
  },
  computed: {
    recurrenceFields () {
      return [this.frequency, this.interval, this.count, this.byweekday, this.bymonth].join()
    }
  },
  watch: {
    recurrenceFields () {
      this.getRRule()
    }
  },
  mounted () {
    if (this.recurrenceData) {
      this.setRRule()
    }
  },
  methods: {
    clearRRule () {
      this.frequency = 0
      this.byweekday = []
      this.bymonth = []
      this.count = null
      this.interval = 1
      this.rruleRaw = null
      this.rruleString = null
    },
    getWeekdays (items) {
      const result = []

      if (!items.length) {
        return result
      }

      items.forEach(function (item) {
        result.push(RRule[item])
      })

      return result
    },
    getWeekdaysFromCaptions (weekdays) {
      const that = this
      const result = []

      if (weekdays == null) {
        return result
      }

      /* convert numeric indexes to captions */
      if (!weekdays.length) {
        return result
      }

      weekdays.forEach(function (item, key) {
        result.push(that.weekdays[item].value)
      })

      return result
    },
    setRRule (recurrenceData) {
      const recurrence = rrulestr(this.recurrenceData)

      this.frequency = recurrence.options.freq
      this.interval = recurrence.options.interval
      this.count = recurrence.options.count
      this.bymonth = recurrence.options.bymonth

      this.byweekday = this.getWeekdaysFromCaptions(recurrence.options.byweekday)

      this.getRRule()
    },
    getRRule () {
      let options = {}

      if (this.frequency !== null) {
        options = Object.assign({}, { freq: this.frequency })
      }

      if (this.interval) {
        options = Object.assign(options, { interval: this.interval.toString() })
      }

      if (this.count) {
        options = Object.assign(options, { count: this.count })
      }

      if (this.byweekday) {
        const weekdays = this.getWeekdays(this.byweekday)
        options = Object.assign(options, { byweekday: weekdays })
      }

      if (this.bymonth) {
        options = Object.assign(options, { bymonth: this.bymonth })
      }

      const rrule = new RRule(options)
      let ruleString = rrule.toText()

      ruleString = ruleString.charAt(0).toUpperCase() + ruleString.slice(1)

      this.rruleString = ruleString
      this.rruleRaw = rrule.toString()
    }
  }
}
</script>
