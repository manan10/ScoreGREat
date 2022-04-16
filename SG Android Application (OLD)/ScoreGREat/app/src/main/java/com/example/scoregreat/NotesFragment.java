package com.example.scoregreat;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
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

public class NotesFragment extends Fragment implements View.OnClickListener {
    EditText title,content;
    FloatingActionButton cl,sn;
    FirebaseAuth mAuth = FirebaseAuth.getInstance();
    FirebaseUser currentUser = mAuth.getCurrentUser();
    DatabaseReference ref = FirebaseDatabase.getInstance().getReference();
    String uid = currentUser.getUid();

    public NotesFragment(){

    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {

        View rv = inflater.inflate(R.layout.activity_notes_fragment, container, false);


        try{
            title = rv.findViewById(R.id.title);
            rv.findViewById(R.id.exit).setOnClickListener(this);
            content = rv.findViewById(R.id.content);
            cl = getActivity().findViewById(R.id.calc);
            sn = getActivity().findViewById(R.id.note);
            rv.findViewById(R.id.save).setOnClickListener(this);
            rv.findViewById(R.id.clr).setOnClickListener(this);
        }
        catch (NullPointerException n){
            Toast.makeText(getActivity(), n.toString(), Toast.LENGTH_SHORT).show();
        }

        return rv;
    }

    @Override
    public void onClick(View view){
        int id = view.getId();

        switch (id) {
            case R.id.save:
               final String t = title.getText().toString();
               final String c = content.getText().toString();
                if(t.equals("")||c.equals(""))
                    Toast.makeText(getActivity(), "No data to save", Toast.LENGTH_SHORT).show();
                else{
                    ref.child("users").child(uid).child("title_content").addListenerForSingleValueEvent(new ValueEventListener() {
                        @Override
                        public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                            String last = dataSnapshot.getValue().toString();
                            ref.child("users").child(uid).child("title_content").setValue(last.concat(t.concat("\n\t\t".concat(c.concat("\n\n")))));
                        }

                        @Override
                        public void onCancelled(@NonNull DatabaseError databaseError) {

                        }
                    });

                    Toast.makeText(getActivity(), "Your Data has been saved", Toast.LENGTH_SHORT).show();
                    title.setText("");
                    content.setText("");
                }

                break;

            case R.id.clr:
                title.setText("");
                content.setText("");
                break;

            case R.id.exit:
                getActivity().getSupportFragmentManager().popBackStackImmediate();
                cl.setVisibility(View.VISIBLE);
                sn.setVisibility(View.VISIBLE);
        }
    }
}
