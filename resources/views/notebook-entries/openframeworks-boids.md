## Boids

Boids simulate the flocking behavior of birds.

Each boid has the following:

a vector representing acceleration
a vector representing velocity

Each boid will begin with an acceleration of 0,0
And a velocity of random,random

It operates off of three concepts

Separation
Alignment
Cohesion

### Separation

Separation refers to how the boid can check for the location of it's neighbors, and be sure to steer away. The birds do not want to collide.

### Alignment

The average velocity has to be calculated to assure that the boids are heading in the same general direction as a flock.

### Cohesion

The boid needs to generally be steered towards the average position of all nearby boids.

### Construction

Each element has to be aware of the rest of the flock, so a collection of boids needs to be available. 