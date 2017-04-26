app.template.Home = class extends React.Component {
  render() {
    return React.createElement("div", null, "Hello ", this.props.name);
  }
}