class Footer extends React.Component {
    render() {
      return (
        <footer className="foot">
          <p>Registrado como {this.props.person}</p>
        </footer>
      );
    }
  }