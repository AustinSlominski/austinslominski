function randomPoint(normalized,bounds){
	if(bounds == null) bounds = view.size;

	var r_width  = Math.random()*bounds.width;
	var r_height = Math.random()*bounds.height;
	
	if(normalized){
		r_width   = Math.random()*2-1;
		r_height  = Math.random()*2-1;	
	}

	var point    = new Point(r_width,r_height);
	return point;
}

var Rotor = Base.extend({
	initialize: function(){
		this.route = new Path(randomPoint());
		this.route.strokeColor = 'black';
		this.route.strokeWidth = 1;

		this.drawToggle = true;
		this.timer      = 0;
		this.time_limit = 20;
		this.vector     = randomPoint(true);
		this.mag        = 5;
		this.circle_lim = 600;
	},

	gen_circle: function(pos){
		var normal    	   = new Point(this.vector.y,-this.vector.x);	
		var normal_mag    = Math.random() * this.circle_lim - this.circle_lim / 2;
		var p_x      	   = pos.x + normal.x * normal_mag;
		var p_y 	     	   = pos.y + normal.y * normal_mag;		
		var dest_point    = new Point(p_x,p_y);
		
		this.center_point = new Point((pos.x + dest_point.x) / 2,(pos.y + dest_point.y) / 2);	
		this.diameter     = Math.sqrt((dest_point.x-pos.x)*(dest_point.x-pos.x)+(dest_point.y-pos.y)*(dest_point.y-pos.y));
		this.radius 		= this.diameter/2;	
		
		var circle1 = new Shape.Circle({center:this.center_point, radius:this.radius, strokeColor:'grey'});
		var circle2	= new Shape.Circle({center:this.center_point, radius:this.radius/6, strokeColor:'red'});	 
	},

	draw_arc: function(pos){
		//I have to update the vector to reflect the rotation around the circle.
		//so lets rethink this a little bit
		//the function is called and a point is created representing the center of the circle.		


		this.theta = this.theta + 0.002;

		var p_x = Math.cos(this.theta) * this.radius;
		var p_y = Math.sin(this.theta) * this.radius; 
		
		this.vector = new Point(p_x,p_y);
		//pos = this.route.lastSegment.point + this.vector;
		pos = this.vector + this.center_point;
		this.route.add(pos);
	},

	draw_straight: function(pos){
		this.route.add(pos);
	},

	draw: function(){
		if(this.timer < this.time_limit){
			var pos = this.route.lastSegment.point + this.vector * this.mag;

			if(pos.x > view.size.width || pos.y > view.size.height || pos.x < 0 || pos.y < 0){
				pos = new Point(view.size.width - pos.x, view.size.height - pos.y);
				this.route = new Path(pos);
				this.route.strokeColor = 'black';
			}

			if(this.drawToggle){ this.draw_straight(pos); }else{ this.draw_arc(pos); }
		}else{
			this.reset();
		}
	},

	update: function(){
		this.timer++;
	},

	reset: function(){
		this.theta      = 0;
		this.timer      = 0;
		this.time_limit = 50;
		this.drawToggle = !this.drawToggle;
		if(this.drawToggle == false) this.gen_circle(this.route.lastSegment.point);
		this.vector = randomPoint(true);
	},

	run: function(){
		this.draw();
		this.update();
	}
});

var rotor = [];

function onMouseUp(event){
	rotor.push(new Rotor());
}

function onFrame(event){
	for(var i=0; i<rotor.length; i++){
		rotor[i].run();
	}
}


