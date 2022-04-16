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
import android.widget.CheckBox;
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

public class PracticeSE extends AppCompatActivity {

    TextView que;
    CheckBox ch[] = new CheckBox[6];
    Button b, f;
    FloatingActionButton cl, sn;
    int i = 0, flag = 0;
    int cnt1 = 0;
    int usi[] = new int[2];
    String ans[] = new String[3];
    String fAns[] = new String[3];
    private DatabaseReference md;
    SharedPreferences sp;
    public static final String seNAME = "QUES_NO";
    public static final String seNO = "no";

    @SuppressLint({"WrongConstant","RestrictedAPI"})
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_practice_se);

        this.getSupportActionBar().hide();
        final Toolbar mActionBarToolbar = findViewById(R.id.toolbar2);

        mActionBarToolbar.setTitle("Sentence Equivalence Practice");
        FirebaseAuth mAuth = FirebaseAuth.getInstance();
        final FirebaseUser user = mAuth.getCurrentUser();
        final String userid = user.getUid();

        que = findViewById(R.id.que);
        ch[0] = findViewById(R.id.u);
        ch[1] = findViewById(R.id.v);
        ch[2] = findViewById(R.id.w);
        ch[3] = findViewById(R.id.x);
        ch[4] = findViewById(R.id.y);
        ch[5] = findViewById(R.id.z);
        b = findViewById(R.id.next);
        f = findViewById(R.id.ft);
        cl = findViewById(R.id.calc);
        sn = findViewById(R.id.note);
        md = FirebaseDatabase.getInstance().getReference();
        sp = getSharedPreferences(seNAME,MODE_PRIVATE);

        Intent it = getIntent();
        Bundle x = it.getExtras();
        cnt1 = (int) x.getLong("cnt");
        i = (sp.getInt(seNO,1) % cnt1) - 1;
        final String q[] = new String[cnt1];
        for(int j=0; j<cnt1;j++)
            q[j] = "q".concat(String.valueOf(j+1));

        cl.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(PracticeSE.this, "Cannot be used for Vocabulary section", Toast.LENGTH_SHORT).show();
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
                editor.putInt(seNO,1);
                editor.apply();
                Intent i = new Intent(PracticeSE.this,UserHome.class);
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
                int ops = 0;
                flag = 0;
                for(k=0;k<5;k++){
                    if(ch[k].isChecked()) {
                        ops++;
                    }
                }

                if(ops == 2)
                    flag = 1;

                if (flag == 0)
                    Toast.makeText(PracticeSE.this, "Select only two option", Toast.LENGTH_SHORT).show();
                else  {
                    int z = 0;
                    for(k=0;k<5;k++){
                        if(ch[k].isChecked()){
                            usi[z] = k;
                            z++;
                        }
                    }

                    Bundle bundle = new Bundle();
                    bundle.putString("que",fAns[0]);
                    bundle.putString("answer1", fAns[1]);
                    bundle.putString("answer2", fAns[2]);
                    bundle.putString("userAns1",ch[usi[0]].getText().toString());
                    bundle.putString("userAns2",ch[usi[1]].getText().toString());
                    bundle.putInt("que_no",i);
                    bundle.putInt("len",q.length);
                    SEAnswerFragment fm = new SEAnswerFragment();
                    fm.setArguments(bundle);
                    FragmentManager rfm = getSupportFragmentManager();
                    rfm.beginTransaction().replace(R.id.view3, fm).commit();
                    que.setVisibility(View.INVISIBLE);
                    for(int p=0;p<6;p++)
                        ch[p].setVisibility(View.INVISIBLE);
                    b.setVisibility(View.INVISIBLE);
                    cl.setVisibility(View.INVISIBLE);
                    sn.setVisibility(View.INVISIBLE);

                    for(int p=0;p<6;p++)
                        ch[p].setChecked(false);
                    if (i < q.length)
                        fAns = ques(i, q, md);
                    else  {
                        que.setVisibility(View.INVISIBLE);
                        for(int p=0;p<6;p++)
                            ch[p].setVisibility(View.INVISIBLE);
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
        md.child("questions").child("verbal").child("se").child(q[i]).child("que").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                que.setText(dataSnapshot.getValue().toString());
                ans[0] = dataSnapshot.getValue().toString();

            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });


        final String answer[] = new String[2];
        for(int j=0;j<2;j++) {
            final int finalJ = j;
            md.child("questions").child("verbal").child("se").child(q[i]).child("ans").child(String.valueOf(finalJ)).addListenerForSingleValueEvent(new ValueEventListener() {
                @Override
                public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
//                    int m = 0;
//                    for (DataSnapshot ds : dataSnapshot.getChildren()) {
//                        answer[m] = ds.child(String.valueOf(m)).toString();
//                        ans[m + 1] = answer[m];
//                        m++;
//                    }
//                    Toast.makeText(PracticeSE.this, ans[1], Toast.LENGTH_SHORT).show();

                    answer[finalJ] = dataSnapshot.getValue().toString();
                    ans[finalJ+1] = answer[finalJ];
                }

                @Override
                public void onCancelled(@NonNull DatabaseError databaseError) {

                }
            });
        }

        for(int j=0;j<6;j++) {
            final int finalJ = j;
            md.child("questions").child("verbal").child("se").child(q[i]).child("op").child(String.valueOf(finalJ)).addListenerForSingleValueEvent(new ValueEventListener() {
                @Override
                public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                    ch[finalJ].setText(dataSnapshot.getValue().toString());
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
        SharedPreferences sharedPreferences = getSharedPreferences(seNAME,MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putInt(seNO,i);
        editor.apply();
    }
}
