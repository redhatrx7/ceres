app.view.Home = class {
	constructor()
	{
		
	}

	render()
	{
		ReactDOM.render(React.createElement(HelloMessage, {name: 'Jane'}), document.getElementById('react'));
	}
}