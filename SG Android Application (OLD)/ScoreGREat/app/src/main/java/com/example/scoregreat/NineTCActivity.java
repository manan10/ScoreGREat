package com.example.scoregreat;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

public class NineTCActivity extends AppCompatActivity {

    TextView que;
    RadioButton brg1[] = new RadioButton[3];
    RadioButton brg2[] = new RadioButton[3];
    RadioButton brg3[] = new RadioButton[3];
    RadioGroup rg1, rg2, rg3;
    Button b, f;
    FloatingActionButton cl, sn;
    int i = 0, flag = 0;
    int cnt1 = 0;
    int usi[] = new int[3];
    String ans[] = new String[4];
    String fAns[] = new String[4];
    private DatabaseReference md;
    SharedPreferences sp;
    public static final String ntcNAME = "QUES";
    public static final String ntcNO = "no";

    @SuppressLint({"WrongConstant","RestrictedAPI"})
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_nine_tc);

        this.getSupportActionBar().hide();
        final Toolbar mActionBarToolbar = findViewById(R.id.toolbar2);

        mActionBarToolbar.setTitle("Vocabulary Builder");
        FirebaseAuth mAuth = FirebaseAuth.getInstance();
        final FirebaseUser user = mAuth.getCurrentUser();
        final String userid = user.getUid();

        que = findViewById(R.id.que);
        brg1[0] = findViewById(R.id.p);
        brg1[1] = findViewById(R.id.q);
        brg1[2] = findViewById(R.id.r);
        brg2[0] = findViewById(R.id.x);
        brg2[1] = findViewById(R.id.y);
        brg2[2] = findViewById(R.id.z);
        brg3[0] = findViewById(R.id.l);
        brg3[1] = findViewById(R.id.m);
        brg3[2] = findViewById(R.id.n);
        b = findViewById(R.id.next);
        f = findViewById(R.id.ft);
        rg1 = findViewById(R.id.rg1);
        rg2 = findViewById(R.id.rg2);
        rg3 = findViewById(R.id.rg3);
        cl = findViewById(R.id.calc);
        sn = findViewById(R.id.note);
        md = FirebaseDatabase.getInstance().getReference();
        sp = getSharedPreferences(ntcNAME,MODE_PRIVATE);

        Intent it = getIntent();
        Bundle x = it.getExtras();
        cnt1 = (int) x.getLong("cnt");
        i = (sp.getInt(ntcNO,1) % cnt1) - 1;
        final String q[] = new String[cnt1];
        for(int j=0; j<cnt1;j++)
            q[j] = "q".concat(String.valueOf(j+1));

        cl.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(NineTCActivity.this, "Cannot be used for Vocabulary section", Toast.LENGTH_SHORT).show();
            }
        });

        sn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Fragment fragment = new NotesFragment();
                FragmentManager fm = getSupportFragmentManager();
                fm.beginTransaction().replace(R.id.view3, fragment).addToBackStack(null).commit();
                sn.setVisibility(View.INVISIBLE);
                cl.setVisibility(View.INVISIBLE);
            }
        });

        f.setVisibility(View.INVISIBLE);
        f.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                SharedPreferences.Editor editor = sp.edit();
                editor.putInt(ntcNO,1);
                editor.apply();
                Intent i = new Intent(NineTCActivity.this,UserHome.class);
                startActivity(i);
            }
        });

        fAns = ques(i, q, md);
        i++;
        b.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(i < q.length)
                    fAns = ques(i-1,q,md);

                int k, l;
                flag = 0;
                for(k=0;k<3; k++){
                    if(brg1[k].isChecked()) {
                        for(l=0;l<3;l++){
                            if(brg2[l].isChecked()){
                                for(int m=0;m<3;m++){
                                    if(brg3[m].isChecked())
                                        flag = 1;
                                }
                            }
                        }
                    }
                }

                if (flag == 0)
                    Toast.makeText(NineTCActivity.this, "Select at least one option", Toast.LENGTH_SHORT).show();
                else  {
                    for(k=0;k<3;k++){
                        if(brg1[k].isChecked())
                            usi[0] = k;
                        if(brg2[k].isChecked())
                            usi[1] = k;
                        if(brg3[k].isChecked())
                            usi[2] = k;
                    }
                    Bundle bundle = new Bundle();
                    bundle.putString("que",fAns[0]);
                    bundle.putString("answer1", fAns[1]);
                    bundle.putString("userAns1",brg1[usi[0]].getText().toString());
                    bundle.putString("answer2", fAns[2]);
                    bundle.putString("userAns2",brg2[usi[1]].getText().toString());
                    bundle.putString("answer3", fAns[3]);
                    bundle.putString("userAns3",brg3[usi[2]].getText().toString());
                    bundle.putInt("que_no",i);
                    bundle.putInt("len",q.length);
                    NineTCAnswerFragment fm = new NineTCAnswerFragment();
                    fm.setArguments(bundle);
                    FragmentManager rfm = getSupportFragmentManager();
                    rfm.beginTransaction().replace(R.id.view3, fm).commit();
                    que.setVisibility(View.INVISIBLE);
                    rg1.setVisibility(View.INVISIBLE);
                    rg2.setVisibility(View.INVISIBLE);
                    rg3.setVisibility(View.INVISIBLE);
                    b.setVisibility(View.INVISIBLE);
                    cl.setVisibility(View.INVISIBLE);
                    sn.setVisibility(View.INVISIBLE);

                    rg1.clearCheck();
                    rg2.clearCheck();
                    rg3.clearCheck();
                    if (i < q.length)
                        fAns = ques(i, q, md);
                    else  {
                        que.setVisibility(View.INVISIBLE);
                        rg1.setVisibility(View.INVISIBLE);
                        rg2.setVisibility(View.INVISIBLE);
                        rg3.setVisibility(View.INVISIBLE);
                        b.setVisibility(View.INVISIBLE);
                        cl.setVisibility(View.INVISIBLE);
                        sn.setVisibility(View.INVISIBLE);
                    }
                    i++;
                }
            }
        });
    }

    public String[] ques(int i, String q[], DatabaseReference md) {
        md.child("questions").child("verbal").child("tc").child("nine").child(q[i]).child("que").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                que.setText(dataSnapshot.getValue().toString());
                ans[0] = dataSnapshot.getValue().toString();
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });

        for (int j = 0; j < 9; j++) {
            final int finalJ = j;
            md.child("questions").child("verbal").child("tc").child("nine").child(q[i]).child("op").child(String.valueOf(j)).addListenerForSingleValueEvent(new ValueEventListener() {
                @Override
                public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                    if(finalJ < 3)
                        brg1[finalJ].setText(dataSnapshot.getValue().toString());
                    else if(finalJ >= 3 && finalJ <6)
                        brg2[finalJ-3].setText(dataSnapshot.getValue().toString());
                    else
                        brg3[finalJ-6].setText(dataSnapshot.getValue().toString());
                }

                @Override
                public void onCancelled(@NonNull DatabaseError databaseError) {

                }
            });
        }

        final String answer[] = new String[3];
        for(int j=0;j<3;j++) {
            final int finalJ = j;
            md.child("questions").child("verbal").child("tc").child("nine").child(q[i]).child("ans").child(String.valueOf(finalJ)).addListenerForSingleValueEvent(new ValueEventListener() {
                @Override
                public void onDataChange(@NonNull DataSnapshot dataSnapshot) {

                    answer[finalJ] = dataSnapshot.getValue().toString();
                    ans[finalJ+1] = answer[finalJ];
                }

                @Override
                public void onCancelled(@NonNull DatabaseError databaseError) {

                }
            });
        }

        return ans;
    }

    @Override
    public void onBackPressed(){
        super.onBackPressed();
        SharedPreferences sharedPreferences = getSharedPreferences(ntcNAME,MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putInt(ntcNO,i);
        editor.apply();
    }

}
