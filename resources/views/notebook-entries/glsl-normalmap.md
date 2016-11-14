## Normal Maps in GLSL

I have been working on creating a shader for vertex displacement, but for that, I need to recalculate all of the normals of my mesh. One method to do so is to use a *Normal Map*. A normal map is an image that represents the vectors for each point of the object using RGB. 

I can create the normal map using the texture that I use for displacement. To do so, I've seen 

