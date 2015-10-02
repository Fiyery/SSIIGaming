var nb_consultants = 0;

var event_manager = {
	'events': {},
	'run' : null,
	'length': 0,
	// Interval in second beetween each events generation.
	'period': 0.001,
	'add' : function(id, e) {
		this.events[id] = e;	
		this.length++;
	},
	'remove': function(id) {
		if (this.events[id]) {
			delete this.events[id];
			this.length--;
		}
	},
	'handle': function(){
		for (k in this.events) {
			e = this.events[k];
			if (e.occur()) {
				e.handle();
			} 
		}
		console.log(this.length);
	},
	'start': function(){
		that = this;
		this.run = setInterval(function() {
			that.handle()
		}, this.period*1000);
	},
	'stop': function(){
		clearInterval(this.run);
	}
};

var event = {
	'name': null,
	// Up to thousand
	'frequence': 0,
	'id': 0,
	'occur': function(){
		return ((Math.random()*1000) <= this.frequence); 
	}, 
	'handle' : function(){

	}
};

var departure = Object.create(event);
departure.name = 'Departure';
departure.frequence = 1; 
departure.handle = function(){
	// console.log('Departure ! :'+this.id);
	event_manager.remove('departure_'+this.id);
	nb_consultants--;
}

var recruitment = Object.create(event);
recruitment.name = 'Recruitement';
recruitment.frequence = 100;
recruitment.id = 0;
recruitment.handle = function(){
	// console.log('Recruitement !');
	var d = Object.create(departure);
	d.id = this.id;
	event_manager.add('departure_'+this.id, d);
	nb_consultants++;
	this.id++;
}

event_manager.add('global_recrutement', recruitment);
// event_manager.start();






