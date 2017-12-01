<template>
  <div class="countdown">
    {{ days | two_digits }}D 
    {{ hours | two_digits }}H
    {{ minutes | two_digits }}M 
    {{ seconds | two_digits }}S
  </div>
</template>

<script>
export default {
  props: {
    date: null
  },

  data () {
    return {
      now: Math.trunc((new Date()).getTime() / 1000),
      event: this.date
    }
  },

  computed: {
    calculatedDate () {
      this.event = Math.trunc(Date.parse(this.event) / 1000)
      return this.event
    },
    seconds () {
      return (this.calculatedDate - this.now) % 60
    },
    minutes () {
      return Math.trunc((this.calculatedDate - this.now) / 60) % 60
    },
    hours () {
      return Math.trunc((this.calculatedDate - this.now) / 60 / 60) % 24
    },
    days () {
      return Math.trunc((this.calculatedDate - this.now) / 60 / 60 / 24)
    }
  },

  mounted () {
    window.setInterval(() => {
      this.now = Math.trunc((new Date()).getTime() / 1000)
    }, 1000)
  },
  
  filters: {
    two_digits: function (value) {
      if(value.toString().length <= 1)
      {
        return "0"+value.toString();
      }
      return value.toString();
    }
  }

}
</script>