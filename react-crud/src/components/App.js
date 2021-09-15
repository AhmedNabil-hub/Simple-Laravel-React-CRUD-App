import { Component } from "react";
import MyForm from "./MyForm";
import "./app.css";
import CustomerList from "./CustomerList";
import axios from "axios";
import Loader from "./Loader";

class App extends Component
{
  state = {
    customers: [],
    loader:false,
    url: "http://127.0.0.1:8000/api/customers"
  };

  getCustomers = async () => {
    this.setState({ loader: true });
    const customers = await axios.get(this.state.url);
    this.setState({ customers: customers.data, loader: false })
  };

  componentDidMount() {
    this.getCustomers();
  };

  render() {
    return(
      <div>
        <div className="ui fixed inverted menu">
          <div className="ui container">
            <a href="/#" className="header item">
              React JS CRUD with Laravel API
            </a>
          </div>
        </div>

        <div className="ui main container">
          <MyForm />
          {this.state.loader ? <Loader /> : ""}
          <CustomerList customers={this.state.customers} />
        </div>
      </div>
    );
  }
}

export default App;
