import React, { Component } from 'react';
import { BrowserRouter } from 'react-router-dom';
import Fullscreen from "react-full-screen";

import { createStore, applyMiddleware } from 'redux';
import { Provider } from 'react-redux';

import allReducers from './Reducers/index';

import Layout from './Pages/Layouts/Layout';
import RootLayout from './Pages/Layouts/RootLayout';

import createSagaMiddleware from 'redux-saga';
import RootSaga from './Sagas/RootSaga';
const sagaMiddleware = createSagaMiddleware();
let store = createStore(allReducers,
  window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__(),
  applyMiddleware(sagaMiddleware));

class App extends Component {
  constructor(props) {
    super();

    this.state = {
      isFull: true,
    };
  }
  goFull = () => {
    this.setState({ isFull: true });
  }

  componentDidMount() {
    this.goFull();
  }
  render() {
    return (
      <Fullscreen
        enabled={this.state.isFull}
        onChange={isFull => this.setState({ isFull })}
      >
        <Provider store={store}>
          <BrowserRouter>
            <RootLayout {...this.props}/>
          </BrowserRouter>

        </Provider>
      </Fullscreen>
    );
  }
}

sagaMiddleware.run(RootSaga);
export default App;
