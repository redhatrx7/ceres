/**
 * @class Home
 * 
 * @description Home view
 * 
 * @module ceres
 * @author Daniel Demetroulis
 * @since version 1.0.0
 * @namespace app.view
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