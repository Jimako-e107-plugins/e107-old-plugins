// Create namespace
if (at == undefined) var at = {};
if (at.bartelme == undefined) at.bartelme = {};

// Newsticker Class
at.bartelme.newsticker = Class.create();
at.bartelme.newsticker.prototype = {
	initialize: function()
	{
		// Get elements
		this.interval = 10000;
		this.container = $("newsticker");
		this.messages  = $A(this.container.getElementsByTagName("li"));
		this.number_of_messages = this.messages.length;
		if (this.number_of_messages == 0)
		{
			this.showError();
			return false;
		}
		this.current_message = 0;
		this.previous_message = null;
		// Create toggle button
		this.toggle_button = document.createElement("a");
		this.toggle_button.href = "#";
		this.toggle_button.id = "togglenewsticker";
		this.toggle_button.innerHTML = "Toggle";
		Event.observe(this.toggle_button, "click", this.toggle.bindAsEventListener(this), false);
		this.container.appendChild(this.toggle_button);
		this.hideMessages();
		this.showMessage();
		// Install timer
		this.timer = setInterval(this.showMessage.bind(this), this.interval);
  	},
	showMessage: function()
	{
		Effect.Appear(this.messages[this.current_message]);
		setTimeout(this.fadeMessage.bind(this), this.interval-2000);
		if (this.current_message < this.number_of_messages-1)
		{
			this.previous_message = this.current_message;
			this.current_message = this.current_message + 1;
		} else {
			this.current_message = 0;
			this.previous_message = this.number_of_messages - 1;
		}
	},
	fadeMessage: function()
	{
		Effect.Fade(this.messages[this.previous_message]);
	},
	hideMessages: function()
	{
		this.messages.each(function(message)
		{
			Element.hide(message);
		})
	},
	toggle: function()
	{
		Effect.BlindUp(this.container, 1000);
	},
	showError: function()
	{
		if (this.container.getElementsByTagName("ul").length == 0)
		{
			this.list = document.createElement("ul");
			this.container.appendChild(this.list);
		} else {
			this.list = this.container.getElementsByTagName("ul")[0];
		}
		this.errorMessage = document.createElement("li");
		this.errorMessage.className = "error";
		this.errorMessage.innerHTML = "Could not retrieve data";
		this.list.appendChild(this.errorMessage);
	}
}

Event.observe(window, "load", function(){new at.bartelme.newsticker()}, false);
