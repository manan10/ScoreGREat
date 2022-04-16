package com.example.scoregreat;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentTransaction;

import android.graphics.Color;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.LinearLayout;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

public class SixTCAnswerFragment extends Fragment implements View.OnClickListener {

    TextView que, cans, uans, mQue,checkans;
    Button check,ch1;
    FloatingActionButton cl,sn;
    RadioGroup rg1,rg2;
    LinearLayout ll;
    int i=0,j=0;
    Button fin;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View rv = inflater.inflate(R.layout.activity_six_tcanswer_fragment, container, false);
        String answer1,yourans1,answer2,yourans2;

        try{
            que = rv.findViewById(R.id.que);
            cans = rv.findViewById(R.id.marks1);
            uans = rv.findViewById(R.id.uans);
            check = rv.findViewById(R.id.home);
            checkans = rv.findViewById(R.id.checkans);
            ll = rv.findViewById(R.id.lay_checkans);
            rv.findViewById(R.id.home).setOnClickListener(this);

            mQue = getActivity().findViewById(R.id.que);
            cl = getActivity().findViewById(R.id.calc);
            sn = getActivity().findViewById(R.id.note);
            ch1 = getActivity().findViewById(R.id.next);
            fin = getActivity().findViewById(R.id.ft);
            rg1 = getActivity().findViewById(R.id.rg1);
            rg2 = getActivity().findViewById(R.id.rg2);

            answer1 = this.getArguments().getString("answer1");
            yourans1 = this.getArguments().getString("userAns1");
            answer2 = this.getArguments().getString("answer2");
            yourans2 = this.getArguments().getString("userAns2");
            i = this.getArguments().getInt("que_no");
            j = this.getArguments().getInt("len");

            que.setText(this.getArguments().getString("que"));
            cans.setText("Correct Answers: " + this.getArguments().getString("answer1") + ", " +  this.getArguments().getString("answer2"));
            uans.setText("Your Answers: " + this.getArguments().getString("userAns1") + ", " + this.getArguments().getString("userAns2"));
            check.setBackgroundColor(Color.rgb(255, 179, 102));

            if((answer1.equals(yourans1) && answer2.equals(yourans2))){
                checkans.setText("Correct");
                checkans.setTextColor(Color.BLACK);
                ll.setBackgroundColor(Color.rgb(159, 255, 128));
                checkans.setBackgroundColor(Color.rgb(159, 255, 128));
            }
            else {
                checkans.setText("Incorrect");
                ll.setBackgroundColor(Color.rgb(255, 51, 51));
                checkans.setBackgroundColor(Color.rgb(255, 51, 51));
            }
        }
        catch (NullPointerException n){

        }
        return rv;
    }

    @Override
    public void onClick(View view) {
        int id = view.getId();

        if(id == R.id.home) {
            Fragment f = new Fragment();
            FragmentTransaction fm = getFragmentManager().beginTransaction();
            fm.replace(R.id.view3,f).commit();
            if(i<j) {
                mQue.setVisibility(View.VISIBLE);
                rg1.setVisibility(View.VISIBLE);
                rg2.setVisibility(View.VISIBLE);
                cl.setVisibility(View.VISIBLE);
                sn.setVisibility(View.VISIBLE);
                ch1.setVisibility(View.VISIBLE);
            }
            else
                fin.setVisibility(View.VISIBLE);
        }

        else{
            Toast.makeText(getActivity(), "Enter valid input", Toast.LENGTH_SHORT).show();
        }

    }
}
