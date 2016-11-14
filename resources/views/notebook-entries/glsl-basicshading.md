## Basic Shading in GLSL

*http://www.opengl-tutorial.org/beginners-tutorials/tutorial-8-basic-shading/*

I will attempt this again. This is about the third retry, but it's essential. This time I will pay much more attention to the mathematics, both of the lighting, but also the perspective and the transformation matrices. I can't do without it.


### THE NORMALS

First of all, the normal of a triangle is a vector with the length of 1, that is perpendicular to two of it's sides. Any two sides. The triangle vector is computed *by taking the cross product of two edges*. The cross product of two edges will result in a point perpendicular to both.

```
triange (v1,v2,v3) //basic triangle
edgeA = v2-v1;
edgeB = v3-v1;
triangle.normal = cross(edgeA,edgeB).normalize();
```

The normal of a vertex is the combination of it's surrounding triangle normals (the other triangles that share the same point):

```
vertex v1, v2, v3, .... 
triangle tr1, tr2, tr3 // all share vertex v1
v1.normal = normalize( tr1.normal + tr2.normal + tr3.normal )
```

A normal is *an attribute of a vertex*.


### DIFFUSE LIGHTING

Diffuse lighting is light that scatters in all directions. The angle at which that light hits a surface is important though, a severe angle throws less light, and also changes the shape of how it hits. If it is dead on, it is large and even.

While calculating the diffuse component, you need to make calculations involving the surface normal, and the vector pointing towards the light. This involves taking the dot product of the *surface normal and the unit vector from the surface to the light*

```
// Cosine of the angle between the normal and the light direction,
// clamped above 0
//  - light is at the vertical of the triangle -> 1
//  - light is perpendicular to the triangle -> 0
float cosTheta = dot( n,l );

color = LightColor * cosTheta;
```

Now, we have to clamp cosTheta to 0 - 1, because a negative number means nothing.

```
// Cosine of the angle between the normal and the light direction,
// clamped above 0
//  - light is at the vertical of the triangle -> 1
//  - light is perpendicular to the triangle -> 0
//  - light is behind the triangle -> 0
float cosTheta = clamp( dot( n,l ), 0,1 );

color = LightColor * cosTheta;
```

### MATERIAL COLOR

Obviously, the color of the material factors into this. We apply the MaterialDiffuseColor as follows:

```
color = MaterialDiffuseColor * LightColor * cosTheta;
```

### MATRICES

Now we need to talk matrices. I have another set of notes on the matrices, so now we'll just focus on implementing them within the shader. so we can, at the moment, calculate everything we need for simple diffuse lighting.

Let's focus on how to calculate n and l, for cosTheta. As always, we'll start by setting the location of our vertex.

```
gl_Position = modelViewProjectionMatrix * position;
```

Now, as I said before, n is the *surface normal*, and l is the vector *from the surface to the light*. For this we need two things, the normal passed in by the vertex, and the location of the light within ofApp.cpp, and pass it in. These need to be changed to work in *camera space*.

```
shader.setUniform3f("lightPosition_worldspace",lightPosition);
```

The model matrix has been a source of confusion for me. According to a post in an openGL forum, there is no need for separate model and view matrices in modern openGL. You can have them seperately, but the identity matrix I don't think really factors in.








Currently, what I have confused is the normal matrix, the normal calculation, and the light direction calculation





















Shading doesn't just happen, it's the result of calculating where the light is, where it's pointed, how strong it is and in what directions, what the material is, what the angle the material is at, etc. There is a lot going on with simple shading. 

One of the core elements of lighting is the vertex normal. The normal is a direction, perpendicular to the surface. For example, the normal of a plane is pointing outwards. The *vertex normal* though at first seems confusing. How can something be perpendicular to a point? You actually have to use the other surrounding points to calculate the normal of a vertex.

If your geometry is being affected by the shader, you will need to recalculate your normals before you are able to shade it. To do so, there are a few methods, the method that I am going to explain is *to create a normal map to correspond with my displacement map*.

### Creating a Normal Map

[HERE][2]

### Calculating Normals and Lighting / Otherwise

I can't entirely tell if the normal map method is the way to go. I've been pointed towards the shader within ofMaterial.cpp, which essentially outlines the method for material shading in the same way as the opengl-tutorial.org article does, so I will be trying to work through that implementation.

Let's begin with what we need to pass into our vertex shader, basicLighting.vert.

### basicLighting.vert

The tutorial I am following suggests this:

```
// Output position of the vertex, in clip space : MVP * position
gl_Position =  MVP * vec4(vertexPosition_modelspace,1);

// Position of the vertex, in worldspace : M * position
Position_worldspace = (M * vec4(vertexPosition_modelspace,1)).xyz;

// Vector that goes from the vertex to the camera, in camera space.
// In camera space, the camera is at the origin (0,0,0).
vec3 vertexPosition_cameraspace = ( V * M * vec4(vertexPosition_modelspace,1)).xyz;
EyeDirection_cameraspace = vec3(0,0,0) - vertexPosition_cameraspace;

// Vector that goes from the vertex to the light, in camera space. M is ommited because it's identity.
vec3 LightPosition_cameraspace = ( V * vec4(LightPosition_worldspace,1)).xyz;
LightDirection_cameraspace = LightPosition_cameraspace + EyeDirection_cameraspace;

// Normal of the the vertex, in camera space
Normal_cameraspace = ( V * M * vec4(vertexNormal_modelspace,0)).xyz; // Only correct if ModelMatrix does not scale the model ! Use its inverse transpose if not.
```

What I take out of this is I need to calculate the following outside of the shader:

MVP: ModelViewProjectionMatrix
M: ModelMatrix
V: ViewMatrix
vertexNormal_modelspace:
LightPosition_cameraspace: location of the light in camera space
vertexPosition_modelspace: location of vertex in modelspace (gl_Vertex/position)


```
    vec4 pos = position * modelViewProjectionMatrix;
    
    vec3 Position_worldspace = (modelMatrix * position).xyz;
    
    vec3 vertexPosition_cameraspace = ( viewMatrix * modelMatrix * position).xyz;
    
    vec3 EyeDirection_cameraspace = vec3(0,0,0) - vertexPosition_cameraspace;
    
    vec3 LightPosition_cameraspace = ( V * lightPosition_worldspace).xyz;
    
    LightDirection_cameraspace = LightPosition_cameraspace + EyeDirection_cameraspace;
``` 

Now, let's calculate and input these uniforms to the vertex shader

```
    shader_displace.setUniformMatrix4f("modelViewProjectionMatrix", cam.getModelViewProjectionMatrix());
    shader_displace.setUniformMatrix4f("modelMatrix", ident);
    shader_displace.setUniformMatrix4f("viewMatrix", cam.getModelViewMatrix());
    shader_displace.setUniform3f("lightPosition_worldspace", light.getPosition());
```






What I don't understand at the moment is how to just simply display a 3D sphere with a single, solid color on it. I don't even need it shaded right now, just I need it to display. The 02 shader example might give me some insight. Maybe the key lies within uniform vec4 globalColor. That apparently is how I can get the color from ofSetColor() for example.

I am still getting a plane, stretching out into infinity. Why do I not get the sphere?
Just drawing the sphere is fine.
But when the shader is introduced, it's a plane.

I was getting a plane because I had the order incorrect while setting the vertex position. 

```
gl_Position = modelViewProjectionMatrix * pos;
```

is the correct order.

Now I'm at a new issue, in some way, my shader isn't taking into account the position and transformation of the camera. My assumption was that the modelViewProjectionMatrix would do this, but something to do with rotation and position is in the way.












I have to keep in mind the vertex normals. These are vectors that are perpendicular to the vertex, which, since it's a single point, the *normal of a vertex* is actually the combined normals of it's surrounding triangle. With a triangle, you just take the cross product of it's two edges, and with that, you get the perpendicular vector.

How do I calculate vectors? Are they already there? They couldn't be, right? I suppose it's just an attribute of the vertex, of the triangle. It's just what is perpendicular, and there is a formula to find this. I'll move on for now.

Diffuse light is the light that is scattered when in contact with a physical object. If the angle of the light is perpendicular to the surface, you are going to get a more concentrated light. If it is at an angle, it will spread across a greater area.

Below, n is the *surface normal*, and l is the unit vector that goes from the *surface to the light*. Calculating the angle between the surface and the light source is easier if you are finding the angle relative to it's own surface. If l is 1, the light is directly above the surface, and the closer it is to 0, the smaller that angle is.

```
float cosTheta = dot( n,l );

color = LightColor * cosTheta;
```

Then, clamp cosTheta to 0 - 1, because we have no use of negative numbers (which would result from the light coming from *behind* the surface).

The color of the material has to be taken into account as well, factoring into that color variable.

```
color = MaterialDiffuseColor * LightColor * cosTheta;
```

Now, factor in the distance and the strength

```
color = MaterialDiffuseColor * LightColor * LightPower * cosTheta / (distance*distance);
```

LightColor and LightPower will be uniforms in the shader. The materialDiffuseColor is fetched from the texture.

We can compute n and l using the camera space

```
vec3 n = normalize( Normal_cameraspace );
vec3 l = normalize( LightDirection_cameraspace );
```

Normal_cameraspace and LightDirection_cameraspace will be calculated within the vertex shader.

```
// Output position of the vertex, in clip space : MVP * position
gl_Position =  MVP * vec4(vertexPosition_modelspace,1);

// Position of the vertex, in worldspace : M * position
Position_worldspace = (M * vec4(vertexPosition_modelspace,1)).xyz;

// Vector that goes from the vertex to the camera, in camera space.
// In camera space, the camera is at the origin (0,0,0).
vec3 vertexPosition_cameraspace = ( V * M * vec4(vertexPosition_modelspace,1)).xyz;
EyeDirection_cameraspace = vec3(0,0,0) - vertexPosition_cameraspace;

// Vector that goes from the vertex to the light, in camera space. M is ommited because it's identity.
vec3 LightPosition_cameraspace = ( V * vec4(LightPosition_worldspace,1)).xyz;
LightDirection_cameraspace = LightPosition_cameraspace + EyeDirection_cameraspace;

// Normal of the the vertex, in camera space
Normal_cameraspace = ( V * M * vec4(vertexNormal_modelspace,0)).xyz; // Only correct if ModelMatrix does not scale the model ! Use its inverse transpose if not.
```

This leaves me with a few questions, mainly what is MVP, and when and how was it sent here. V is the View Matrix, and M is the Model Matrix.

MVP is the model view projection matrix, which can be accessed with gl_ModelViewProjectionMatrix.

Now, what is the vertexPosition_modelspace? I have a feeling it might just be gl_Vertex.	

Is there a way to just get all of these other matrices with built in functions? 

Worldspace
Cameraspace
Model

### Writing a basic lighting shader for openFrameworks

It appears to me right now that 

```
gl_Position =  MVP * vec4(vertexPosition_modelspace,1);
```

is equivalent to 

```
gl_Position = gl_ModelViewProjectionMatrix * gl_Vertex;
```

Here is a question: what is the variable gl_ModelViewProjectionMatrix called? Where does it come from?

Well, according to a post [here][1], modern openGL makes you handle these matrices yourself, meaning you have to create them and pass them in as a uniform.  This is what GLM is for, to do these kinds of CPU calculations to pass on to the shader as uniform variables. 

gl_ModelViewProjectionMatrix is an example of a *built in uniform variable*, which does that maths for you. which, as I just said, is deprecated in modern openGL.

[1]: https://www.opengl.org/discussion_boards/showthread.php/172143-gl_ModelViewMatrix-gl_ModelViewProjectionMatrix

[2]: Link to normal map notes
