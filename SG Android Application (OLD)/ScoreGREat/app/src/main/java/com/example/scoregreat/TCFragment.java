package com.example.scoregreat;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;

import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

public class TCFragment extends Fragment {

    Button go1,go2;
    DatabaseReference md;
    long fCnt;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {

        View rv = inflater.inflate(R.layout.activity_tcfragment, container, false);

        try {
            go1 = rv.findViewById(R.id.firstgo);
            go2 = rv.findViewById(R.id.sgo);
            md = FirebaseDatabase.getInstance().getReference();
        }
        catch (NullPointerException n){

        }

        go1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                md.child("questions").child("verbal").child("tc").child("six").addListenerForSingleValueEvent(new ValueEventListener() {
                    @Override
                    public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                        fCnt = dataSnapshot.getChildrenCount();
                        nextPage(fCnt,1);
                    }

                    @Override
                    public void onCancelled(@NonNull DatabaseError databaseError) {

                    }
                });

            }
        });

        go2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                md.child("questions").child("verbal").child("tc").child("nine").addListenerForSingleValueEvent(new ValueEventListener() {
                    @Override
                    public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                        fCnt = dataSnapshot.getChildrenCount();
                        nextPage(fCnt,2);
                    }

                    @Override
                    public void onCancelled(@NonNull DatabaseError databaseError) {

                    }
                });
            }
        });

        return rv;
    }

    public void nextPage(long v,int x) {
        Intent i;
        Bundle bun = new Bundle();
        bun.putLong("cnt",v);
        if(x == 1)
            i = new Intent(getActivity(), SixTCActivity.class);
        else
            i = new Intent(getActivity(), NineTCActivity.class);

        i.putExtras(bun);
        startActivity(i);
    }
}
