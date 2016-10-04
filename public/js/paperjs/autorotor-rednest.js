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
		this.route             = new Path(randomPoint());
		this.route.strokeColor = '#ff8080'; //TODO: allow all colors in the entire sketch to change at random but keep relationship
		this.route.opacity	  = 1;
		this.route.strokeWidth = 1;
		this.dead				  = false;
		this.drawToggle        = true;
		this.timer             = 0;
		this.time_limit        = 20;
		this.vector            = randomPoint(true);
		this.mag               = 2;
		this.circle_lim        = new Point(100,200);
	},

	gen_circle: function(pos){
		this.normal    	= new Point(this.vector.y,-this.vector.x);
		this.normal_mag   = Math.random() * (this.circle_lim.y * 2) - this.circle_lim.y;
		if(this.normal_mag > -this.circle_lim.x && this.normal_mag < this.circle_lim.x){
			if(this.normal_mag > 0){this.normal_mag += this.circle_lim.x;}else{this.normal_mag -= this.circle_lim.x;}
		}
		var p_x      	   = pos.x + this.normal.x * this.normal_mag;
		var p_y 	     	   = pos.y + this.normal.y * this.normal_mag;		
		var dest_point    = new Point(p_x,p_y);
		
		this.center_point = new Point((pos.x + dest_point.x) / 2,(pos.y + dest_point.y) / 2);	
		this.diameter     = Math.sqrt((dest_point.x - pos.x) * (dest_point.x - pos.x) + (dest_point.y - pos.y) * (dest_point.y - pos.y));
		this.radius 		= this.diameter / 2;		
	},

	draw_arc: function(pos){
		if(this.normal_mag > 0){
			this.t_dir = -1;
		}else if(this.normal_mag < 0){
			this.t_dir = 1;
		}
		this.t_spd = 0.025; 
		this.theta = Math.atan2(this.route.lastSegment.point.y-this.center_point.y,this.route.lastSegment.point.x-this.center_point.x)+(this.t_dir*this.t_spd);
	
		var p_x    = (Math.cos(this.theta) * this.radius) + this.center_point.x;
		var p_y    = (Math.sin(this.theta) * this.radius) + this.center_point.y;
		
		pos = new Point(p_x,p_y);
		this.route.add(pos);
	},

	draw_straight: function(pos){
		this.route.add(pos);
	},

	draw: function(wrapping){
		if(this.timer < this.time_limit){
			var pos = this.route.lastSegment.point + this.vector * this.mag;

			if(pos.x > view.size.width || pos.y > view.size.height || pos.x < 0 || pos.y < 0){
				//TODO: consider fixing the wrapping, or at least have a method of allowing the line to be deleted. Maybe stick with wrapping.
				//lines are just shooting out of control
				if(wrapping == "tiling"){
					pos = new Point(view.size.width - pos.x, view.size.height - pos.y);//placement on the other side
					this.route = new Path(pos);//create a new route so that points don't attach
					this.route.strokeColor = 'black';	
				}	
			}
		 	//TODO: try out having an option for different wrapping types. Tiling, disappearing, etc
			//TODO: Fade mode on the wrapping section. When you pass, begin a fade to zero, upon which the line is deleted.	
			if(this.drawToggle){this.draw_straight(pos);}else{this.draw_arc(pos);}
		}else{
			this.reset();
		}

		if(this.route.opacity <= 0.002){
			this.dead = true;
			this.route.remove();
		}
	},

	update: function(){
		this.timer++;
		//TODO: have the alpha channel update here.
		//TODO: Also include a method that allows for a "comet" kind of tail effect !!!
		this.route.opacity -= 0.002;
	},

	reset: function(){
		this.timer      = 0;
		this.time_limit = (Math.random()*50)+20;
		this.drawToggle = !this.drawToggle;
		
		if(this.drawToggle == false){
			this.gen_circle(this.route.lastSegment.point);
		}else{
	   	var t_slope = new Point(this.center_point.y-this.route.lastSegment.point.y,this.center_point.x-this.route.lastSegment.point.x);	
			
			if(Math.abs(t_slope.x) > Math.abs(t_slope.y)){ 
				if(t_slope.x < 0){
					var slope = new Point(-1,t_slope.y/Math.abs(t_slope.x));
				}else{
					var slope = new Point(1,t_slope.y/t_slope.x);
				}
			}else{
				if(t_slope.y < 0){
					var slope = new Point(t_slope.x/Math.abs(t_slope.y),-1);
				}else{
					var slope = new Point(t_slope.x/t_slope.y,1);
				}
			}

			if(this.t_dir < 0){
				this.vector = new Point(-1 * slope.x,slope.y);
			}else{
				this.vector = new Point(slope.x,-1 * slope.y);
			}
		}
	},

	run: function(){
		this.draw("fade");
		this.update();
	}
});

var rotor = [];
var burstSize = 50;
var burstInterval = 10000;
//TODO: have some sort of random time mechanism for triggering new bursts.

var background = new Shape.Rectangle(new Point(0,0),new Size(view.size.width,view.size.height));
background.fillColor = "#ff4d4d";

setInterval(function(){
	for(var i=0; i<burstSize; i++){
		rotor.push(new Rotor());
	}
},3000);

function onFrame(event){
	for(var i=0; i<rotor.length; i++){
		if(rotor[i].dead == false){
			rotor[i].run();
		}
	}
}
