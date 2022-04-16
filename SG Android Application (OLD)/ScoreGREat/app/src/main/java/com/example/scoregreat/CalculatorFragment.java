package com.example.scoregreat;

import androidx.fragment.app.Fragment;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

public class CalculatorFragment extends Fragment implements View.OnClickListener {
    TextView e,his;
    float c = 0, d = 0;
    char op = ' ';
    boolean once = false, multiple = false;
    FloatingActionButton cl,sn;

    public CalculatorFragment(){

    }
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState){

        View rv = inflater.inflate(R.layout.activity_calculator_fragment,container,false);

        try {
            cl = getActivity().findViewById(R.id.calc);
            sn = getActivity().findViewById(R.id.note);
            e = rv.findViewById(R.id.screen);
            his = rv.findViewById(R.id.history);
            rv.findViewById(R.id.exit).setOnClickListener(this);
            rv.findViewById(R.id.one).setOnClickListener(this);
            rv.findViewById(R.id.two).setOnClickListener(this);
            rv.findViewById(R.id.three).setOnClickListener(this);
            rv.findViewById(R.id.four).setOnClickListener(this);
            rv.findViewById(R.id.five).setOnClickListener(this);
            rv.findViewById(R.id.six).setOnClickListener(this);
            rv.findViewById(R.id.seven).setOnClickListener(this);
            rv.findViewById(R.id.eight).setOnClickListener(this);
            rv.findViewById(R.id.nine).setOnClickListener(this);
            rv.findViewById(R.id.zero).setOnClickListener(this);
            rv.findViewById(R.id.dot).setOnClickListener(this);
            rv.findViewById(R.id.ans).setOnClickListener(this);
            rv.findViewById(R.id.add).setOnClickListener(this);
            rv.findViewById(R.id.sub).setOnClickListener(this);
            rv.findViewById(R.id.multi).setOnClickListener(this);
            rv.findViewById(R.id.div).setOnClickListener(this);
            rv.findViewById(R.id.root).setOnClickListener(this);
            rv.findViewById(R.id.mod).setOnClickListener(this);
            rv.findViewById(R.id.clr).setOnClickListener(this);
            rv.findViewById(R.id.del).setOnClickListener(this);

        }
        catch (NullPointerException n){

        }
        return  rv;
    }


    @Override
    public void onClick(View view) {
        int id = view.getId();

            switch (id)
            {
                case R.id.one:
                    if(e.getText().toString().contentEquals("0"))
                        e.setText("1");
                    else
                        e.setText(e.getText()+"1");
                    break;

                case R.id.two:
                    if(e.getText().toString().contentEquals("0"))
                        e.setText("2");
                    else
                        e.setText(e.getText()+"2");
                    break;

                case R.id.three:
                    if(e.getText().toString().contentEquals("0"))
                        e.setText("3");
                    else
                        e.setText(e.getText()+"3");
                    break;

                case R.id.four:
                    if(e.getText().toString().contentEquals("0"))
                        e.setText("4");
                    else
                        e.setText(e.getText()+"4");
                    break;

                case R.id.five:
                    if(e.getText().toString().contentEquals("0"))
                        e.setText("5");
                    else
                        e.setText(e.getText()+"5");
                    break;

                case R.id.six:
                    if(e.getText().toString().contentEquals("0"))
                        e.setText("6");
                    else
                        e.setText(e.getText()+"6");
                    break;

                case R.id.seven:
                    if(e.getText().toString().contentEquals("0"))
                        e.setText("7");
                    else
                        e.setText(e.getText()+"7");
                    break;

                case R.id.eight:
                    if(e.getText().toString().contentEquals("0"))
                        e.setText("8");
                    else
                        e.setText(e.getText()+"8");
                    break;

                case R.id.nine:
                    if(e.getText().toString().contentEquals("0"))
                        e.setText("9");
                    else
                        e.setText(e.getText()+"9");
                    break;

                case R.id.zero:
                    if(e.getText().toString().contentEquals("0"))
                        e.setText("0");
                    else
                        e.setText(e.getText()+"0");
                    break;

                case R.id.dot:
                    String q = e.getText().toString();
                    if(q.contains("."))
                        e.setText(e.getText());
                    else
                        e.setText(e.getText()+".");
                    break;

                case R.id.clr:
                    e.setText("0");
                    his.setText("0");
                    op = ' ';
                    c = 0;
                    d = 0;
                    once = false;
                    multiple = false;
                    break;

                case R.id.del:
                    String z = e.getText().toString();
                    if(z.length() > 1)
                        e.setText(z.substring(0,z.length()-1));
                    else
                        e.setText("0");
                    break;

                case R.id.add:
                    if(e.getText().toString().equals("") == true) {
                        Toast.makeText(getActivity(), "Please enter valid input", Toast.LENGTH_SHORT).show();
                        e.setText("0");
                    }
                    else if(multiple == false) {
                        his.setText(e.getText().toString());
                        c = Float.parseFloat(e.getText().toString());
                        op = '+';
                        e.setText("");
                        multiple = true;
                    }
                    else
                        Toast.makeText(getActivity(), "Please do One Operation at a time!", Toast.LENGTH_SHORT).show();
                    break;

                case R.id.sub:
                    if(e.getText().toString().equals("") == true) {
                        Toast.makeText(getActivity(), "Please Enter Valid Input", Toast.LENGTH_SHORT).show();
                        e.setText("0");
                    }
                    else if(multiple == false) {
                        his.setText(e.getText().toString());
                        c = Float.parseFloat(e.getText().toString());
                        op = '-';
                        e.setText("");
                        multiple = true;
                    }
                    else
                        Toast.makeText(getActivity(), "Please do One Operation at a time!", Toast.LENGTH_SHORT).show();
                    break;

                case R.id.multi:
                    if(e.getText().toString().equals("") == true) {
                        Toast.makeText(getActivity(), "Please Enter Valid Input", Toast.LENGTH_SHORT).show();
                        e.setText("0");
                    }
                    else if(multiple == false) {
                        his.setText(e.getText().toString());
                        c = Float.parseFloat(e.getText().toString());
                        op = '*';
                        e.setText("");
                        multiple = true;
                    }
                    else
                        Toast.makeText(getActivity(), "Please do One Operation at a time!", Toast.LENGTH_SHORT).show();
                    break;

                case R.id.div:
                    if(e.getText().toString().equals("") == true) {
                        Toast.makeText(getActivity(), "Please Enter Valid Input", Toast.LENGTH_SHORT).show();
                        e.setText("0");
                    }
                    else if(multiple == false) {
                        his.setText(e.getText().toString());
                        c = Float.parseFloat(e.getText().toString());
                        op = '/';
                        e.setText("");
                        multiple = true;
                    }
                    else
                        Toast.makeText(getActivity(), "Please do one operation at a time!", Toast.LENGTH_SHORT).show();
                    break;

                case R.id.root:
                    op = '√';

                    if(once == true)
                        Toast.makeText(getActivity(), "Please Clear Screen First!!!", Toast.LENGTH_SHORT).show();
                    else{
                        his.setText("" + op + "".concat(e.getText().toString()));
                        c = Float.parseFloat(e.getText().toString());
                        e.setText(String.valueOf(Math.sqrt(c)));
                        once = true;
                    }

                    break;

                case R.id.mod:
                    if(e.getText().toString().equals("") == true) {
                        Toast.makeText(getActivity(), "Please Enter Valid Input", Toast.LENGTH_SHORT).show();
                        e.setText("0");
                    }
                    else if(multiple == false) {
                        his.setText(e.getText().toString());
                        c = Float.parseFloat(e.getText().toString());
                        op = '%';
                        e.setText("");
                        multiple = true;
                    }
                    else
                        Toast.makeText(getActivity(), "Please do one operation at a time!", Toast.LENGTH_SHORT).show();
                    break;

                case R.id.ans:
                    if(once == true)
                        Toast.makeText(getActivity(), "Please Clear Screen First!!!", Toast.LENGTH_SHORT).show();
                    else {
                        d = Float.parseFloat(e.getText().toString());
                        his.setText(his.getText().toString().concat("" + op + "".concat(e.getText().toString())));

                        float f = 0;
                        if (op == '+')
                            f = c + d;

                        else if (op == '-')
                            f = c - d;

                        else if (op == '*')
                            f = c * d;

                        else if (op == '/')
                            f = c / d;

                        else if (op == '%')
                            f = c % d;

                        c = f;
                        e.setText(String.valueOf(f));
                        once = true;
                        multiple = false;
                    }
                    break;

                case R.id.exit:
                    getActivity().getSupportFragmentManager().popBackStackImmediate();
                    cl.setVisibility(View.VISIBLE);
                    sn.setVisibility(View.VISIBLE);
            }

    }
}
