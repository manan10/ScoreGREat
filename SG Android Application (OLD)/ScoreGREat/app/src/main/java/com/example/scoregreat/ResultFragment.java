package com.example.scoregreat;

import androidx.fragment.app.Fragment;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

public class ResultFragment extends Fragment implements View.OnClickListener {
    TextView marks,marks1;

    public ResultFragment(){

    }

    @Override
    public void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {

        View rv = inflater.inflate(R.layout.activity_result_fragment, container, false);
        try {
            marks = rv.findViewById(R.id.marks);
            marks1 = rv.findViewById(R.id.marks1);
            rv.findViewById(R.id.home).setOnClickListener(this);
            marks.setText("Your Score");
            marks1.setText(this.getArguments().getString("marks").concat("/20"));
        }
        catch (NullPointerException n){
            Toast.makeText(getActivity(), n.toString(), Toast.LENGTH_SHORT).show();
        }

        return rv;
    }

    @Override
    public void onClick(View view) {
        int id = view.getId();

        if(id == R.id.home) {
            Intent i = new Intent(getContext(),UserHome.class);
            startActivity(i);
        }

        else{
            Toast.makeText(getActivity(), "Enter valid input", Toast.LENGTH_SHORT).show();
        }

    }
}
