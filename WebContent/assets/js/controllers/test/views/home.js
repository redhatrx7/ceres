app.view.Home = class {
	constructor()
	{
		
	}

	render()
	{
		ReactDOM.render(React.createElement(app.template.Home, {name: 'Jane'}), document.getElementById('home'));
	}
}