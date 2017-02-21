## Naming Conventions

My own personal conventions, I'm working out the kinks in them as I go, it just helps for me to keep a copy of all of my standards.

### Object Names

For objects like ofShaders, or ofPolyline, etc, use the type name first, then the descriptor. Otherwise, if there is only one instance, use a name like 'video' or 'polyline'.

```
ofShader shader_displacement, shader_fbm;
ofPolyline poly_wave, poly_silhouette;
```

### Temporary variables

Use the t_ prefix if the variable is initialized somewhere other than at setup, and will tend to be overwritten often.

``` 
vec3 t_vec;
```



