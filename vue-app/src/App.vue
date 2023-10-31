<template>
  <div id="app">
    <img src="./assets/logo.png">
    <div class="container">
      <div class="container-one">
        <select name="first-currency" id="first-currency" v-model="currency_one" @change="fetchData()">
          <option v-for="currency in currencies" :key="currency" :value="currency">{{currency}}</option>
        </select>
        <input type="number" name="input-one" id="input-one" @change="fetchData()" @keypress="fetchData()" v-model="amountOne" />
      </div>
      <div class="container-two">
        <button @click="switchValues()">Switch</button>
        <h4 id="baseValue">1 {{ currency_one }} = {{ rate }} {{ currency_two }}</h4>
      </div>
      <div class="container-three">
        <select name="second-currency" id="second-currency" v-model="currency_two" @change="fetchData()">
          <option v-for="currency in currencies" :key="currency" :value="currency">{{currency}}</option>
        </select>
        <input type="number" name="input-two" placeholder="0" v-model="ammountTwo" disabled id="input-two" />
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'App',
  data() {
    return {
      currencies: [
        'EUR',
        'USD',
        'GBP',
        'JPY',
        'AUD',
        'CAD',
        'CNY',
        'INR',
        'MXN',
        'BRL',
        'ZAR',
        'RUB',
        'SEK',
        'NOK',
        'DKK',
        'SGD',
        'HKD',
        'NZD'
      ],
      data: [],
      currency_one: "USD",
      currency_two: "EUR",
      rate: "",
      amountOne: 1,
      ammountTwo: 0,
    }
  },
  methods: {
    fetchData() {
      axios.get(`http://localhost:8082/getCurrencyData?currency=${this.currency_one}`)
      .then(resp => resp.data).then(data => {
          console.log(data)
          this.data = data
          this.rate = data.conversion_rates[this.currency_two]
          this.ammountTwo = this.amountOne * this.rate.toFixed(2)
      });
    },

    switchValues() {
      const tempValue = this.currency_one
      this.currency_one = this.currency_two
      this.currency_two = tempValue
      this.fetchData()
    }
  },
  mounted() {
    this.fetchData()
  }
}
</script>

<style>
html{
  background: #f4f4f4;
}
#app {
 display: flex;
  flex-direction: column;
  align-items: center;
  align-content: center;
  width: 100%;
  height: 100%;
}

img {
  width: 150px;
}

.container{
  width: 50%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-content: center;
  align-items: center;
  text-align: center;
}

.container-two {
  display: flex;
  align-items: center;
  justify-content: space-around;
  width: 50%;
}

.container-two button {
  padding: 5px;
  font-size: 18px;
  background-color: #5fbaaf;
  color: white;
  width: 30%;
  height: 10%;
  border: none;
  outline: none;
}

select {
  padding: 5px;
  margin: 5px;
  border: 1px solid rgb(0,0,0);
  outline: none;
}

input{
  padding: 5px;
  margin: 5px;
  border: 1px solid rgb(0,0,0);
  outline: none;
  font-size:18px;
}

#baseValue {
  font-weight: 500;
}
button {
  cursor: pointer;
}
</style>
