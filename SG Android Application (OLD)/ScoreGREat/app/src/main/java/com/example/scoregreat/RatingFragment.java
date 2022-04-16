package com.example.scoregreat;

import androidx.fragment.app.Fragment;

import android.graphics.Color;
import android.graphics.PorterDuff;
import android.graphics.drawable.LayerDrawable;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.RatingBar;
import android.widget.TextView;

public class RatingFragment extends Fragment implements View.OnClickListener {

    RatingBar ratingBar;
    LayerDrawable stars;
    TextView t;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View rv = inflater.inflate(R.layout.activity_rating_fragment, container, false);


        try{
            ratingBar = rv.findViewById(R.id.ratingBar);
            t = rv.findViewById(R.id.textView8);
            rv.findViewById(R.id.button).setOnClickListener(this);
            ratingBar.setOnClickListener(this);
            stars = (LayerDrawable) ratingBar.getProgressDrawable();
            stars.getDrawable(2).setColorFilter(Color.rgb(255,204,0), PorterDuff.Mode.SRC_ATOP);
        }
        catch (NullPointerException n){

        }
        return rv;
    }


    @Override
    public void onClick(View view) {
        int id = view.getId();

        switch (id){
            case R.id.button:
                t.setText("You Rated :" + ratingBar.getRating());
                break;
        }
    }
}
