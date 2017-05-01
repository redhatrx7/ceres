/**
 * @class app.view.Home
 * 
 * @description Home view
 * 
 * @author Daniel Demetroulis
 * @since version 1.0.0
 */
app.view.Home = class {
	constructor()
	{
		
	}

	/**
	 * @description render react dom
	 */
	render()
	{
		ReactDOM.render(React.createElement(app.template.Home, {name: 'Jane'}), document.getElementById('home'));
	}
}