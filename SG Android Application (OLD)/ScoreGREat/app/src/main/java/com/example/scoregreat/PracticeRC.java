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

public class PracticeRC extends AppCompatActivity {

    TextView que;
    RadioButton a[] = new RadioButton[5];
    RadioGroup rg;
    Button b, f;
    FloatingActionButton cl, sn;
    int i = 0, flag = 0;
    int cnt1 = 0;
    int usi;
    String ans[] = new String[2];
    String fAns[] = new String[2];
    private DatabaseReference md;
    SharedPreferences sp;
    public static final String rcNAME = "QUES_NO";
    public static final String rcNO = "no";

    @SuppressLint({"WrongConstant","RestrictedAPI"})
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_practice_rc);

        this.getSupportActionBar().hide();
        final Toolbar mActionBarToolbar = findViewById(R.id.toolbar2);

        mActionBarToolbar.setTitle("Verbal Builder");
        FirebaseAuth mAuth = FirebaseAuth.getInstance();
        final FirebaseUser user = mAuth.getCurrentUser();
        final String userid = user.getUid();

        que = findViewById(R.id.que);
        a[0] = findViewById(R.id.a);
        a[1] = findViewById(R.id.b);
        a[2] = findViewById(R.id.c);
        a[3] = findViewById(R.id.d);
        a[4] = findViewById(R.id.e);
        b = findViewById(R.id.next);
        f = findViewById(R.id.ft);
        rg = findViewById(R.id.rg);
        cl = findViewById(R.id.calc);
        sn = findViewById(R.id.note);
        md = FirebaseDatabase.getInstance().getReference();
        sp = getSharedPreferences(rcNAME,MODE_PRIVATE);

        Intent it = getIntent();
        Bundle x = it.getExtras();
        cnt1 = (int) x.getLong("cnt");
        if(cnt1 != 1)
            i = (sp.getInt(rcNO,1) % cnt1) - 1;
        else
            i = (sp.getInt(rcNO,1)) - 1;
        final String q[] = new String[cnt1];
        for(int j=0; j<cnt1;j++)
            q[j] = "q".concat(String.valueOf(j+1));

        cl.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(PracticeRC.this, "Cannot be used for Verbal section", Toast.LENGTH_SHORT).show();
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
                editor.putInt(rcNO,1);
                editor.apply();
                Intent i = new Intent(PracticeRC.this,UserHome.class);
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

                int k;
                flag = 0;
                for(k=0;k<5;k++){
                    if(a[k].isChecked())
                        flag = 1;
                }

                if (flag == 0)
                    Toast.makeText(PracticeRC.this, "Select at least one option", Toast.LENGTH_SHORT).show();
                else  {
                    for(k=0;k<5;k++){
                        if(a[k].isChecked()){
                            usi = k;
                        }
                    }
                    Bundle bundle = new Bundle();
                    bundle.putString("que",fAns[0]);
                    bundle.putString("answer", fAns[1]);
                    bundle.putString("userAns",a[usi].getText().toString());
                    bundle.putInt("que_no",i);
                    bundle.putInt("len",q.length);
                    AnswerFragment fm = new AnswerFragment();
                    fm.setArguments(bundle);
                    FragmentManager rfm = getSupportFragmentManager();
                    rfm.beginTransaction().replace(R.id.view3, fm).commit();
                    que.setVisibility(View.INVISIBLE);
                    rg.setVisibility(View.INVISIBLE);
                    b.setVisibility(View.INVISIBLE);
                    cl.setVisibility(View.INVISIBLE);
                    sn.setVisibility(View.INVISIBLE);

                    rg.clearCheck();
                    if (i < q.length)
                        fAns = ques(i, q, md);
                    else  {
                        que.setVisibility(View.INVISIBLE);
                        rg.setVisibility(View.INVISIBLE);
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
        md.child("questions").child("verbal").child("rc").child(q[i]).child("que").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                que.setText(dataSnapshot.getValue().toString());
                ans[0] = dataSnapshot.getValue().toString();
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });

        for (int j = 0; j < 5; j++) {
            final int finalJ = j;
            md.child("questions").child("verbal").child("rc").child(q[i]).child("op").child(String.valueOf(j)).addListenerForSingleValueEvent(new ValueEventListener() {
                @Override
                public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                    a[finalJ].setText(dataSnapshot.getValue().toString());
                }

                @Override
                public void onCancelled(@NonNull DatabaseError databaseError) {

                }
            });
        }

        final String answer[] = new String[1];
        md.child("questions").child("verbal").child("rc").child(q[i]).child("ans").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                answer[0] = dataSnapshot.getValue().toString();
                ans[1] = answer[0];
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });
        return ans;
    }

    @Override
    public void onBackPressed(){
        super.onBackPressed();
        SharedPreferences sharedPreferences = getSharedPreferences(rcNAME,MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putInt(rcNO,i);
        editor.apply();
    }
}
