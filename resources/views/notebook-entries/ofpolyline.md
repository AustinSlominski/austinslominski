## Filling an ofPolyline with a solid color

```maskFbo.begin();
    for(int i = 0; i < contourFinder.size(); i++){
        ofPolyline & t_poly = contourFinder.getPolyline(i);
        unsigned int label = contourFinder.getLabel(i);
        
        ofBeginShape();
        if(label % 3 == 0){
            glColor3f(1, 0, 0);
        } else if(label % 3 == 1){
            glColor3f(0, 1, 0);
        } else if(label % 3 == 2){
            glColor3f(0, 0, 1);
        }
        for( int j = 0; j < t_poly.getVertices().size(); j++) {
            ofVertex(t_poly.getVertices().at(j).x, t_poly.getVertices().at(j).y);
        }
        ofEndShape();
        
        t_poly.draw();
    }
maskFbo.end();
```

The polylines that I get from the contourFinder can be filled by using the GL drawing methods. Above, we use a pointer to the polyline (t_poly), get the associated label  from the tracker (label), and then using the label, we assign either red, green, or blue.
