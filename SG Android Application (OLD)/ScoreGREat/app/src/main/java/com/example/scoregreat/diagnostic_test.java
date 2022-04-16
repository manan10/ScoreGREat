package com.example.scoregreat;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import android.annotation.SuppressLint;
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

public class diagnostic_test extends AppCompatActivity {
    TextView que;
    RadioButton a[] = new RadioButton[5];
    RadioGroup rg;
    Button b, f;
    FloatingActionButton cl, sn;
    int i = 0, cnt = 0;
    boolean diag;
    String ans[] = new String[2];
    String fAns[] = new String[2];
    private DatabaseReference md;

    @SuppressLint({"WrongConstant","RestrictedAPI"})

    @Override
    public void onBackPressed() {
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_diagnostic_test);

        this.getSupportActionBar().hide();
        final Toolbar mActionBarToolbar = findViewById(R.id.toolbar2);

        mActionBarToolbar.setTitle("Diagnostic Test");
        FirebaseAuth mAuth = FirebaseAuth.getInstance();
        final FirebaseUser user = mAuth.getCurrentUser();
        final String userid = user.getUid();

        final String q[] = new String[]{"q1", "q2", "q3", "q4", "q5"};

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
        md.child("users").child(userid).child("diag").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                diag = Boolean.parseBoolean(dataSnapshot.getValue().toString());
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });


        cl.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                Fragment fragment = new CalculatorFragment();
                FragmentManager fm = getSupportFragmentManager();
                fm.beginTransaction().replace(R.id.view3, fragment).addToBackStack(null).commit();
                sn.setVisibility(View.INVISIBLE);
                cl.setVisibility(View.INVISIBLE);
            }
        });

        sn.setOnClickListener(new View.OnClickListener() {
            @SuppressLint("RestrictedApi")
            @Override
            public void onClick(View view) {

                Toast.makeText(diagnostic_test.this, "Cant Use notes during Diagnoastic Test", Toast.LENGTH_SHORT).show();
            }
        });


        f.setVisibility(View.INVISIBLE);
        f.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Bundle bundle = new Bundle();
                bundle.putString("marks", String.valueOf(cnt));
                ResultFragment fm = new ResultFragment();
                fm.setArguments(bundle);
                FragmentManager rfm = getSupportFragmentManager();
                rfm.beginTransaction().replace(R.id.view3, fm).commit();
                f.setVisibility(View.INVISIBLE);
                mActionBarToolbar.setVisibility(View.INVISIBLE);
                diag = true;
                md.child("users").child(userid).child("diag").setValue(diag);
            }
        });

        fAns = ques(i, q, md);
        i++;
        b.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                fAns = ques(i-1,q,md);
                for(int k=0;k<5;k++){
                    if(a[k].isChecked() && a[k].getText().toString().equals(fAns[0]))
                        cnt += Integer.parseInt(fAns[1]);
                }
                rg.clearCheck();
                if (i < q.length)
                    fAns = ques(i, q, md);
                else  {
                    que.setVisibility(View.INVISIBLE);
                    rg.setVisibility(View.INVISIBLE);
                    f.setVisibility(View.VISIBLE);
                    b.setVisibility(View.INVISIBLE);
                    cl.setVisibility(View.INVISIBLE);
                    sn.setVisibility(View.INVISIBLE);
                    i = -1;
                }
                i++;
            }
        });
    }

    public String[] ques(int i, String q[], DatabaseReference md) {
        md.child("questions").child("diagnostic").child(q[i]).child("que").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                que.setText(dataSnapshot.getValue().toString());
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });

        for (int j = 0; j < 5; j++) {
            final int finalJ = j;
            md.child("questions").child("diagnostic").child(q[i]).child("op").child(String.valueOf(j)).addListenerForSingleValueEvent(new ValueEventListener() {
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
        md.child("questions").child("diagnostic").child(q[i]).child("ans").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                answer[0] = dataSnapshot.getValue().toString();
                ans[0] = answer[0];
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });

        md.child("questions").child("diagnostic").child(q[i]).child("point").addListenerForSingleValueEvent(new ValueEventListener() {
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
}
