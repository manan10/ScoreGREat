package com.example.scoregreat;


import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

public class HomeFragment extends Fragment {
    Button b;
    int flag = 0;
    TextView que,temp;
    boolean diag1[] = new boolean[1];
    private FirebaseAuth mAuth;
    private DatabaseReference md;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);


    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState){
        View rootView = inflater.inflate(R.layout.activity_home_fragment,container,false);
        mAuth = FirebaseAuth.getInstance();
        md = FirebaseDatabase.getInstance().getReference();

        FirebaseUser currentUser = mAuth.getCurrentUser();
        String ab = currentUser.getUid();
        try {
            b = rootView.findViewById(R.id.prac);
            que = rootView.findViewById(R.id.que);
            temp = rootView.findViewById(R.id.temp);
            temp.setVisibility(View.INVISIBLE);
        }
        catch (NullPointerException e){

        }
        final boolean[] diag = new boolean[1];
        md.child("users").child(ab).child("diag").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                diag[0] = Boolean.parseBoolean(dataSnapshot.getValue().toString());
                if(diag[0])
                    b.setText("Start Practice");
                else
                    b.setText("Start Diagnostic Test");
                //temp.setText(String.valueOf(diag[0]));
                //Toast.makeText(getActivity(),temp.getText().toString() , Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });

       b.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                    if(!diag[0]){
                    Intent i = new Intent(getActivity(),diagnostic_test.class);
                    startActivity(i);
                }
                else{
                    Fragment f = new PracticeFragment();
                    FragmentManager fm = getFragmentManager();
                    fm.beginTransaction().replace(R.id.container,f).addToBackStack(null).commit();
                }
            }
        });

        md.child("users").child(ab).child("un").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                que.setText("Welcome "+ dataSnapshot.getValue().toString());
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });
        return rootView;
    }
}
